<?php /** @noinspection PhpUnused */

namespace aki\telegram;

use aki\telegram\base\Response;
use aki\telegram\base\TelegramBase;
use GuzzleHttp\Exception\GuzzleException;
use yii\base\InvalidArgumentException;
use yii\base\UnknownMethodException;

/**
 * Telegram Bot API client for Yii2.
 *
 * Any Bot API method can be invoked as `$telegram->methodName($params)`.
 * Calls are forwarded to the Telegram API via {@see call()}; only methods
 * with custom behavior are implemented explicitly.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 *
 * @method Response sendMessage(array $params = [])
 * @method Response forwardMessage(array $params = [])
 * @method Response copyMessage(array $params = [])
 * @method Response sendPhoto(array $params = [])
 * @method Response sendAudio(array $params = [])
 * @method Response sendDocument(array $params = [])
 * @method Response sendVideo(array $params = [])
 * @method Response sendAnimation(array $params = [])
 * @method Response sendVoice(array $params = [])
 * @method Response sendVideoNote(array $params = [])
 * @method Response sendLocation(array $params = [])
 * @method Response sendVenue(array $params = [])
 * @method Response sendContact(array $params = [])
 * @method Response sendPoll(array $params = [])
 * @method Response sendDice(array $params = [])
 * @method Response sendChatAction(array $params = [])
 * @method Response sendGame(array $params = [])
 * @method Response sendSticker(array $params = [])
 * @method Response sendInvoice(array $params = [])
 * @method Response editMessageText(array $params = [])
 * @method Response editMessageCaption(array $params = [])
 * @method Response editMessageMedia(array $params = [])
 * @method Response editMessageReplyMarkup(array $params = [])
 * @method Response editMessageLiveLocation(array $params = [])
 * @method Response stopMessageLiveLocation(array $params = [])
 * @method Response deleteMessage(array $params = [])
 * @method Response answerCallbackQuery(array $params = [])
 * @method Response answerInlineQuery(array $params = [])
 * @method Response getUserProfilePhotos(array $params = [])
 * @method Response getChat(array $params = [])
 * @method Response getChatAdministrators(array $params = [])
 * @method Response getChatMembersCount(array $params = [])
 * @method Response getChatMember(array $params = [])
 * @method Response getChatMemberCount(array $params = [])
 * @method Response leaveChat(array $params = [])
 * @method Response setChatTitle(array $params = [])
 * @method Response setChatDescription(array $params = [])
 * @method Response setChatPhoto(array $params = [])
 * @method Response deleteChatPhoto(array $params = [])
 * @method Response pinChatMessage(array $params = [])
 * @method Response unpinChatMessage(array $params = [])
 * @method Response unpinAllChatMessages(array $params = [])
 * @method Response exportChatInviteLink(array $params = [])
 * @method Response createChatInviteLink(array $params = [])
 * @method Response revokeChatInviteLink(array $params = [])
 * @method Response banChatMember(array $params = [])
 * @method Response kickChatMember(array $params = [])
 * @method Response unbanChatMember(array $params = [])
 * @method Response restrictChatMember(array $params = [])
 * @method Response promoteChatMember(array $params = [])
 * @method Response setChatAdministratorCustomTitle(array $params = [])
 * @method Response setChatPermissions(array $params = [])
 * @method Response setChatStickerSet(array $params = [])
 * @method Response deleteChatStickerSet(array $params = [])
 * @method Response getGameHighScores(array $params = [])
 * @method Response setGameScore(array $params = [])
 * @method Response Game(array $params = [])
 * @method Response CallbackGame(array $params = [])
 * @method Response GameHighScore(array $params = [])
 * @method Response inlineQuery(array $params = [])
 * @method array getUpdates(array $params = [])
 * @method array setWebhook(array $params = [])
 * @method array deleteWebhook(array $params = [])
 * @method array getWebhookInfo(array $params = [])
 * @method array getFile(array $params = [])
 * @method array sendMediaGroup(array $params = [])
 */
class Telegram extends TelegramBase
{
    /**
     * Methods that historically return the raw decoded API array (not {@see Response}).
     * Preserved for backward compatibility with existing projects.
     */
    private const RAW_METHODS = [
        'getUpdates' => true,
        'setWebhook' => true,
        'deleteWebhook' => true,
        'getWebhookInfo' => true,
        'getFile' => true,
        'sendMediaGroup' => true,
    ];

    /**
     * Call any Telegram Bot API method by name.
     *
     * @param string $method API method (with or without leading slash)
     * @param array $params Method parameters
     * @return Response|array Response wrapper, or raw array for {@see RAW_METHODS}
     * @throws GuzzleException
     */
    public function call(string $method, array $params = [])
    {
        $method = ltrim($method, '/');
        $body = $this->send('/' . $method, $params);

        if (isset(self::RAW_METHODS[$method])) {
            return $body;
        }

        return new Response($body);
    }

    /**
     * Forwards unknown method calls to the Telegram Bot API.
     *
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws GuzzleException
     * @throws InvalidArgumentException
     * @throws UnknownMethodException
     */
    public function __call($name, $params)
    {
        try {
            return parent::__call($name, $params);
        } catch (UnknownMethodException $e) {
            $args = $params[0] ?? [];
            if ($args !== [] && !is_array($args)) {
                throw new InvalidArgumentException(
                    'Telegram API method "' . $name . '" expects an array of parameters as the first argument.'
                );
            }

            return $this->call($name, $args);
        }
    }

    /**
     * getMe — wraps the user object for Result hydration.
     *
     * @throws GuzzleException
     */
    public function getMe(): Response
    {
        $body = $this->send('/getMe');

        return new Response([
            'ok' => $body['ok'],
            'result' => [
                'user' => $body['result'],
            ],
        ]);
    }

    /**
     * Return a downloadable file URL for the given file_id.
     *
     * Yii::$app->telegram->getFileUrl(['file_id' => $file_id]);
     *
     * @param array $params
     * @return string|false
     * @throws GuzzleException
     */
    public function getFileUrl(array $params)
    {
        $body = $this->send('/getFile', $params);

        if (!empty($body['ok']) && !empty($body['result']['file_path'])) {
            return rtrim($this->apiUrl, '/') . '/file/bot' . $this->botToken . '/' . $body['result']['file_path'];
        }

        return false;
    }
}
