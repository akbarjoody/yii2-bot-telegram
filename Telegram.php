<?php /** @noinspection PhpUnused */

namespace aki\telegram;

use aki\telegram\base\Response;
use aki\telegram\base\TelegramBase;
use GuzzleHttp\Exception\GuzzleException;
use yii\base\InvalidArgumentException;
use yii\base\UnknownMethodException;

/**
 * Telegram Bot API client for Yii2 (targets Bot API 10.2+).
 *
 * Any Bot API method can be invoked as `$telegram->methodName($params)`.
 * Calls are forwarded to the Telegram API via {@see call()}; only methods
 * with custom behavior are implemented explicitly.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 *
 * @property-read \aki\telegram\base\Input|null $input
 *
 * // Messages
 * @method Response sendMessage(array $params = [])
 * @method Response sendMessageDraft(array $params = [])
 * @method Response sendRichMessage(array $params = [])
 * @method Response sendRichMessageDraft(array $params = [])
 * @method Response forwardMessage(array $params = [])
 * @method array forwardMessages(array $params = [])
 * @method Response copyMessage(array $params = [])
 * @method array copyMessages(array $params = [])
 * @method Response sendPhoto(array $params = [])
 * @method Response sendLivePhoto(array $params = [])
 * @method Response sendAudio(array $params = [])
 * @method Response sendDocument(array $params = [])
 * @method Response sendVideo(array $params = [])
 * @method Response sendAnimation(array $params = [])
 * @method Response sendVoice(array $params = [])
 * @method Response sendVideoNote(array $params = [])
 * @method Response sendPaidMedia(array $params = [])
 * @method Response sendLocation(array $params = [])
 * @method Response sendVenue(array $params = [])
 * @method Response sendContact(array $params = [])
 * @method Response sendPoll(array $params = [])
 * @method Response sendDice(array $params = [])
 * @method Response sendChatAction(array $params = [])
 * @method Response sendGame(array $params = [])
 * @method Response sendSticker(array $params = [])
 * @method Response sendInvoice(array $params = [])
 * @method array sendMediaGroup(array $params = [])
 *
 * // Edit / delete
 * @method Response editMessageText(array $params = [])
 * @method Response editMessageCaption(array $params = [])
 * @method Response editMessageMedia(array $params = [])
 * @method Response editMessageReplyMarkup(array $params = [])
 * @method Response editMessageLiveLocation(array $params = [])
 * @method Response stopMessageLiveLocation(array $params = [])
 * @method Response deleteMessage(array $params = [])
 * @method Response deleteMessages(array $params = [])
 * @method Response setMessageReaction(array $params = [])
 * @method Response deleteMessageReaction(array $params = [])
 * @method Response deleteAllMessageReactions(array $params = [])
 *
 * // Ephemeral messages (Bot API 10.2)
 * @method Response editEphemeralMessageText(array $params = [])
 * @method Response editEphemeralMessageMedia(array $params = [])
 * @method Response editEphemeralMessageCaption(array $params = [])
 * @method Response editEphemeralMessageReplyMarkup(array $params = [])
 * @method Response deleteEphemeralMessage(array $params = [])
 *
 * // Callback / inline / web apps
 * @method Response answerCallbackQuery(array $params = [])
 * @method Response answerInlineQuery(array $params = [])
 * @method Response answerWebAppQuery(array $params = [])
 * @method Response savePreparedInlineMessage(array $params = [])
 * @method Response savePreparedKeyboardButton(array $params = [])
 *
 * // Guest mode (Bot API 10.0)
 * @method Response answerGuestQuery(array $params = [])
 *
 * // Join requests
 * @method Response approveChatJoinRequest(array $params = [])
 * @method Response declineChatJoinRequest(array $params = [])
 * @method Response answerChatJoinRequestQuery(array $params = [])
 * @method Response sendChatJoinRequestWebApp(array $params = [])
 *
 * // Chat info / admin
 * @method Response getUserProfilePhotos(array $params = [])
 * @method Response getUserProfileAudios(array $params = [])
 * @method Response getChat(array $params = [])
 * @method Response getChatAdministrators(array $params = [])
 * @method Response getChatMembersCount(array $params = [])
 * @method Response getChatMemberCount(array $params = [])
 * @method Response getChatMember(array $params = [])
 * @method Response setChatMemberTag(array $params = [])
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
 * @method Response editChatInviteLink(array $params = [])
 * @method Response revokeChatInviteLink(array $params = [])
 * @method Response banChatMember(array $params = [])
 * @method Response kickChatMember(array $params = [])
 * @method Response unbanChatMember(array $params = [])
 * @method Response banChatSenderChat(array $params = [])
 * @method Response unbanChatSenderChat(array $params = [])
 * @method Response restrictChatMember(array $params = [])
 * @method Response promoteChatMember(array $params = [])
 * @method Response setChatAdministratorCustomTitle(array $params = [])
 * @method Response setChatPermissions(array $params = [])
 * @method Response setChatStickerSet(array $params = [])
 * @method Response deleteChatStickerSet(array $params = [])
 * @method Response getForumTopicIconStickers(array $params = [])
 * @method Response createForumTopic(array $params = [])
 * @method Response editForumTopic(array $params = [])
 * @method Response closeForumTopic(array $params = [])
 * @method Response reopenForumTopic(array $params = [])
 * @method Response deleteForumTopic(array $params = [])
 * @method Response unpinAllForumTopicMessages(array $params = [])
 * @method Response editGeneralForumTopic(array $params = [])
 * @method Response closeGeneralForumTopic(array $params = [])
 * @method Response reopenGeneralForumTopic(array $params = [])
 * @method Response hideGeneralForumTopic(array $params = [])
 * @method Response unhideGeneralForumTopic(array $params = [])
 * @method Response unpinAllGeneralForumTopicMessages(array $params = [])
 *
 * // Bot profile / commands / menu
 * @method Response getMe()
 * @method Response close(array $params = [])
 * @method Response logout(array $params = [])
 * @method Response setMyCommands(array $params = [])
 * @method Response deleteMyCommands(array $params = [])
 * @method Response getMyCommands(array $params = [])
 * @method Response setMyName(array $params = [])
 * @method Response getMyName(array $params = [])
 * @method Response setMyDescription(array $params = [])
 * @method Response getMyDescription(array $params = [])
 * @method Response setMyShortDescription(array $params = [])
 * @method Response getMyShortDescription(array $params = [])
 * @method Response setMyProfilePhoto(array $params = [])
 * @method Response removeMyProfilePhoto(array $params = [])
 * @method Response setChatMenuButton(array $params = [])
 * @method Response getChatMenuButton(array $params = [])
 * @method Response setMyDefaultAdministratorRights(array $params = [])
 * @method Response getMyDefaultAdministratorRights(array $params = [])
 *
 * // Stickers
 * @method Response getCustomEmojiStickers(array $params = [])
 * @method Response uploadStickerFile(array $params = [])
 * @method Response createNewStickerSet(array $params = [])
 * @method Response addStickerToSet(array $params = [])
 * @method Response setStickerPositionInSet(array $params = [])
 * @method Response deleteStickerFromSet(array $params = [])
 * @method Response replaceStickerInSet(array $params = [])
 * @method Response setStickerEmojiList(array $params = [])
 * @method Response setStickerKeywords(array $params = [])
 * @method Response setStickerMaskPosition(array $params = [])
 * @method Response setStickerSetTitle(array $params = [])
 * @method Response setStickerSetThumbnail(array $params = [])
 * @method Response setCustomEmojiStickerSetThumbnail(array $params = [])
 * @method Response deleteStickerSet(array $params = [])
 *
 * // Payments / Stars / gifts
 * @method Response answerShippingQuery(array $params = [])
 * @method Response answerPreCheckoutQuery(array $params = [])
 * @method Response getMyStarBalance(array $params = [])
 * @method Response getStarTransactions(array $params = [])
 * @method Response refundStarPayment(array $params = [])
 * @method Response editUserStarSubscription(array $params = [])
 * @method Response createInvoiceLink(array $params = [])
 * @method Response getAvailableGifts(array $params = [])
 * @method Response sendGift(array $params = [])
 * @method Response giftPremiumSubscription(array $params = [])
 * @method Response getUserGifts(array $params = [])
 * @method Response getChatGifts(array $params = [])
 * @method Response setUserEmojiStatus(array $params = [])
 *
 * // Business
 * @method Response getBusinessConnection(array $params = [])
 * @method Response setBusinessAccountName(array $params = [])
 * @method Response setBusinessAccountUsername(array $params = [])
 * @method Response setBusinessAccountBio(array $params = [])
 * @method Response setBusinessAccountProfilePhoto(array $params = [])
 * @method Response removeBusinessAccountProfilePhoto(array $params = [])
 * @method Response setBusinessAccountGiftSettings(array $params = [])
 * @method Response getBusinessAccountStarBalance(array $params = [])
 * @method Response transferBusinessAccountStars(array $params = [])
 * @method Response getBusinessAccountGifts(array $params = [])
 * @method Response convertGiftToStars(array $params = [])
 * @method Response upgradeGift(array $params = [])
 * @method Response transferGift(array $params = [])
 * @method Response postStory(array $params = [])
 * @method Response editStory(array $params = [])
 * @method Response deleteStory(array $params = [])
 *
 * // Managed bots (Bot API 9.6+)
 * @method Response getManagedBotToken(array $params = [])
 * @method Response replaceManagedBotToken(array $params = [])
 * @method Response getManagedBotAccessSettings(array $params = [])
 * @method Response setManagedBotAccessSettings(array $params = [])
 * @method Response getUserPersonalChatMessages(array $params = [])
 *
 * // Games
 * @method Response getGameHighScores(array $params = [])
 * @method Response setGameScore(array $params = [])
 *
 * // Polls
 * @method Response stopPoll(array $params = [])
 *
 * // Webhook / updates / files
 * @method array getUpdates(array $params = [])
 * @method array setWebhook(array $params = [])
 * @method array deleteWebhook(array $params = [])
 * @method array getWebhookInfo(array $params = [])
 * @method array getFile(array $params = [])
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
        'forwardMessages' => true,
        'copyMessages' => true,
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
            'ok' => $body['ok'] ?? false,
            'result' => [
                'user' => $body['result'] ?? null,
            ],
            'error_code' => $body['error_code'] ?? null,
            'description' => $body['description'] ?? null,
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
