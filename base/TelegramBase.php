<?php

namespace aki\telegram\base;

use aki\telegram\types\InputMedia\InputMedia;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use yii\base\Component;

/**
 * HTTP layer for Telegram Bot API requests.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 *
 * @property-read Client $client
 * @property-read Input|null $input
 */
class TelegramBase extends Component
{
    /**
     * Telegram Bot API base URL.
     * @var string
     */
    public $apiUrl = 'https://api.telegram.org';

    /**
     * Token from @BotFather.
     * @var string
     */
    public $botToken;

    /**
     * Bot username (without @).
     * @var string
     */
    public $botUsername = 'Bot';

    /**
     * Optional proxy for Guzzle.
     * Accepts full URL (`socks5://user:pass@host:port`, `http://host:port`)
     * or shorthand `user:pass@host:port` / `host:port` (treated as socks5).
     * @var string|null
     */
    public $proxy;

    /**
     * @var Client|null
     */
    private $_client;

    /**
     * @var Input|null
     */
    private $_input;

    /**
     * Whether webhook input has already been read for this request.
     * @var bool
     */
    private $_inputLoaded = false;

    /**
     * File parameter keys that may contain a local path.
     */
    private const FILE_PARAMS = [
        'photo',
        'sticker',
        'audio',
        'document',
        'video',
        'voice',
        'animation',
        'video_note',
        'thumb',
        'thumbnail',
        'live_photo',
        'certificate',
    ];

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        if ($this->_client === null) {
            $config = [
                'base_uri' => rtrim($this->apiUrl, '/') . '/',
                'http_errors' => false,
            ];

            if (!empty($this->proxy)) {
                $config['proxy'] = $this->normalizeProxy($this->proxy);
            }

            $this->_client = new Client($config);
        }

        return $this->_client;
    }

    /**
     * Normalize proxy config for Guzzle.
     */
    protected function normalizeProxy(string $proxy): string
    {
        if (strpos($proxy, '://') !== false) {
            return $proxy;
        }

        return 'socks5://' . $proxy;
    }

    /**
     * Webhook Update from php://input (cached per request).
     *
     * @return Input|null
     * @noinspection PhpUnused
     */
    protected function getInput(): ?Input
    {
        if ($this->_inputLoaded) {
            return $this->_input;
        }

        $this->_inputLoaded = true;
        $raw = file_get_contents('php://input');
        if ($raw === false || $raw === '') {
            return null;
        }

        try {
            $array = json_decode($raw, true);
            if (!is_array($array)) {
                return null;
            }

            if (!empty($array['message']['via_bot'])) {
                unset($array['message']['via_bot']);
            }

            $this->_input = new Input($array);
        } catch (Exception $ex) {
            return null;
        }

        return $this->_input;
    }

    /**
     * Build Guzzle request options (form_params or multipart).
     *
     * @param array $params
     * @return array
     */
    public function initializeParams(array $params): array
    {
        if ($params === []) {
            return [];
        }

        $isResource = false;
        $multipart = [];

        foreach ($params as $key => $item) {
            if ($key === 'media') {
                $item = $this->mediaInputHelper($item, $isResource, $multipart);
                $multipart[] = ['name' => $key, 'contents' => $item];
                continue;
            }

            if (
                in_array($key, self::FILE_PARAMS, true)
                && is_string($item)
                && $item !== ''
                && @is_file($item)
            ) {
                $file = fopen($item, 'rb');
                $isResource = true;
                $multipart[] = [
                    'name' => $key,
                    'contents' => $file,
                    'filename' => basename($item),
                ];
                continue;
            }

            if (is_bool($item)) {
                $item = $item ? '1' : '0';
            } elseif (is_array($item) || is_object($item)) {
                $item = json_encode($item, JSON_UNESCAPED_UNICODE);
            } elseif ($item === null) {
                continue;
            }

            $multipart[] = ['name' => $key, 'contents' => (string) $item];
        }

        if ($isResource) {
            return ['multipart' => $multipart];
        }

        // Prefer form_params when no file upload is involved.
        $form = [];
        foreach ($params as $key => $item) {
            if ($item === null) {
                continue;
            }
            if (is_array($item) || is_object($item)) {
                $form[$key] = json_encode($item, JSON_UNESCAPED_UNICODE);
            } else {
                $form[$key] = $item;
            }
        }

        return ['form_params' => $form];
    }

    /**
     * POST to Telegram Bot API.
     *
     * @param string $method Path including leading slash, e.g. `/sendMessage`
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function send($method, $params = [])
    {
        $requestParams = $this->initializeParams($params);
        $response = $this->getClient()->post(
            'bot' . $this->botToken . $method,
            $requestParams
        );

        $decoded = json_decode((string) $response->getBody(), true);

        return is_array($decoded) ? $decoded : [
            'ok' => false,
            'description' => 'Invalid JSON response from Telegram API',
            'error_code' => $response->getStatusCode(),
        ];
    }

    /**
     * Attach local files referenced by InputMedia and rewrite media to attach://.
     *
     * @param mixed $item
     * @param bool $isResource
     * @param array $multipart
     * @return string JSON for the media parameter
     */
    public function mediaInputHelper($item, bool &$isResource, &$multipart)
    {
        if (is_string($item)) {
            return $item;
        }

        $wasArray = is_array($item);
        if (!$wasArray) {
            $item = [$item];
        }

        $encoded = [];

        foreach ($item as $mediaItem) {
            if ($mediaItem instanceof InputMedia) {
                $this->attachLocalMediaFiles($mediaItem, $isResource, $multipart);
                $encoded[] = $this->inputMediaToArray($mediaItem);
            } elseif (is_array($mediaItem)) {
                $encoded[] = $this->attachLocalMediaArray($mediaItem, $isResource, $multipart);
            } else {
                $encoded[] = $mediaItem;
            }
        }

        return json_encode($wasArray ? $encoded : $encoded[0], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param InputMedia $mediaItem
     * @param bool $isResource
     * @param array $multipart
     */
    protected function attachLocalMediaFiles(InputMedia $mediaItem, bool &$isResource, array &$multipart): void
    {
        foreach (['media', 'thumbnail', 'thumb'] as $field) {
            if (!property_exists($mediaItem, $field) || empty($mediaItem->$field)) {
                continue;
            }
            $path = $mediaItem->$field;
            if (!is_string($path) || !@is_file($path)) {
                continue;
            }
            $uniqueKey = uniqid($field . '_', false);
            $multipart[] = [
                'name' => $uniqueKey,
                'contents' => fopen($path, 'rb'),
                'filename' => basename($path),
            ];
            $mediaItem->$field = 'attach://' . $uniqueKey;
            $isResource = true;
        }
    }

    /**
     * @param array $mediaItem
     * @param bool $isResource
     * @param array $multipart
     * @return array
     */
    protected function attachLocalMediaArray(array $mediaItem, bool &$isResource, array &$multipart): array
    {
        foreach (['media', 'thumbnail', 'thumb'] as $field) {
            if (empty($mediaItem[$field]) || !is_string($mediaItem[$field]) || !@is_file($mediaItem[$field])) {
                continue;
            }
            $path = $mediaItem[$field];
            $uniqueKey = uniqid($field . '_', false);
            $multipart[] = [
                'name' => $uniqueKey,
                'contents' => fopen($path, 'rb'),
                'filename' => basename($path),
            ];
            $mediaItem[$field] = 'attach://' . $uniqueKey;
            $isResource = true;
        }

        return $mediaItem;
    }

    /**
     * Export InputMedia public properties for JSON encoding.
     *
     * @param InputMedia $mediaItem
     * @return array
     */
    protected function inputMediaToArray(InputMedia $mediaItem): array
    {
        $data = [];
        foreach (get_object_vars($mediaItem) as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $data[$key] = $value;
        }

        return $data;
    }
}
