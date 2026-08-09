<?php

namespace aki\telegram\base;

use aki\telegram\types\InputMedia\InputMedia;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Stream;
use yii\base\Component;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class TelegramBase extends Component
{
    /**
     * @var string api Telegram url
     */
    public $apiUrl = 'https://api.telegram.org';

    /**
     * Token taken from botFather
     * @var string
     */
    public $botToken;

    /**
     * bot username
     */
    public $botUsername = 'Bot';

    /**
     * @var string SOCKS5 proxy format string: <login>:<password>@<host>:<port>
     */
    public $proxy;

    /**
     * @var Client
     */
    private $_client;


    /**
     * @var Input
     */
    private $_input;


    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        if (empty($this->_client)) {
            $this->_client = new Client(['base_uri' => $this->apiUrl]);
        }
        return $this->_client;
    }

    /**
     * @return Input
     * @noinspection PhpUnused
     */
    protected function getInput(): ?Input
    {
        if (empty($this->_input)) {
            $input = file_get_contents('php://input');
            if (!$input) {
                $this->_input = null;
            } else {
                try {
                    $array = json_decode($input, true);
                    if (!empty($array['message']['via_bot'])) {
                        unset($array['message']['via_bot']);
                    }
                    $this->_input = new Input($array);
                }
                catch (Exception $ex) {
                    return null;
                }
            }
        }

        return $this->_input;
    }

    /**
     * initializeParams
     * @param array $params
     * @return array
     */
    public function initializeParams(array $params): array
    {
        $is_resource = false;
        $multipart    = [];

        if (empty($params)) {
            return [];
        }

        //Reformat data array in multipart way if it contains a resource
        $attachments = ['photo', 'sticker', 'audio', 'document', 'video', 'voice', 'animation', 'video_note', 'thumb', 'thumbnail'];
        foreach ($params as $key => $item) {
            if ($key === 'media') {
                // Magical media input helper.
                $item = $this->mediaInputHelper($item, $is_resource, $multipart);
            } else if (in_array($key, $attachments, true) && file_exists($item)) {
                $file = fopen($item, 'rb');
                $is_resource |= is_resource($file);
                $multipart[] = ['name' => $key, 'contents' => $file];
                continue; // already attached as resource; do not also send the raw path
            }

            $multipart[]  = ['name' => $key, 'contents' => $item];
        }
        if ($is_resource) {

            return ['multipart' => $multipart];
        }

        return ['form_params' => $params];
    }

    /**
     * send request
     * @param String $method
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function send($method, $params = [])
    {
        $request_params = $this->initializeParams($params);
        $response = $this->getClient()->post('/bot' . $this->botToken . $method, $request_params);
        return json_decode($response->getBody(), true);
    }

    /**
     * 
     */
    public function mediaInputHelper($item, bool &$is_resource, &$multipart)
    {
        $was_array = is_array($item);
        $was_array || $item = [$item];

        /** @var InputMedia|null $media_item */
        foreach ($item as $media_item) {
            if (!($media_item instanceof InputMedia)) {
                continue;
            }
            $possible_medias = array_filter([
                'media' => $media_item->media,
            ]);

            foreach ($possible_medias as $type => $media) {
                // Allow absolute paths to local files.
                $media          = new Stream(fopen($media, 'rb'));
                $is_resource    = true;
                $unique_key     = uniqid($type . '_', false);
                $multipart[]    = ['name' => $unique_key, 'contents' => $media];
            }
        }
        return json_encode($item);
    }
}
