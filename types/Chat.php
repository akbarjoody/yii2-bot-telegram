<?php

namespace aki\telegram\types;


use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object represents a chat.
 */
class Chat extends Type
{
    /**
     * Unique identifier for this chat.
     *  This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. 
     * But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     * 
     * @var Integer
     */
    public $id;

    public $update_id;

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     * @var String
     */
    public $type;

    /**
     * Optional. Title, for supergroups, channels and group chats
     * @var String
     */
    public $title;

    /**
     * Optional. Username, for private chats, supergroups and channels if available
     * @var String
     */
    public $username;

    /**
     * Optional. First name of the other party in a private chat
     * @var String
     */
    public $first_name;

    /**
     * Optional. Last name of the other party in a private chat
     * @var String
     */
    public $last_name;

    /**
     * Optional. Chat photo. Returned only in getChat.
     * @var aki\telegram\types\ChatPhoto
     */
    public $photo;

    /**
     * Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
     * @var String
     */
    public $description;

    /**
     *  @var String
     * Optional. Chat invite link, for groups, supergroups and channel chats.
     *  Each administrator in a chat generates their own invite links, 
     * so the bot must first generate the link using exportChatInviteLink. 
     * Returned only in getChat.
     */
    public $invite_link;

    /**
     * Optional. Pinned message, for groups, supergroups and channels. Returned only in getChat.
     * @var aki\telegram\types\Message
     */
    public $pinned_message;

    /**
     * Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
     * @var aki\telegram\types\ChatPermissions
     */
    public $permissions;

    /**
     * Optional. For supergroups, 
     * the minimum allowed delay between consecutive messages sent by each unpriviledged user.
     *  Returned only in getChat.
     * @var Integer
     */
    public $slow_mode_delay;

    /**
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     *  @var String
     */
    public $sticker_set_name;

    /**
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     * @var Boolean
     */
    public $can_set_sticker_set;

    /**
     * deprecated
     */
    public $all_members_are_administrators;

    /**
    * Optional. True, if the supergroup chat is a forum (has topics enabled)
    */
    public $is_forum;

    /**
    * Optional. If non-empty, the list of all active chat usernames; for private chats, supergroups and channels.
    * Returned only in getChat.
    */
    public $active_usernames;

    /**
    * @param Array ReactionType
    * Optional. List of available reactions allowed in the chat. If omitted, 
    * then all emoji reactions are allowed. Returned only in getChat.
    */
    public $available_reactions;

    /**
    * @param Integer
    * Optional. Identifier of the accent color for the chat name and backgrounds of the chat photo, reply header, 
    * and link preview. See accent colors for more details. Returned only in getChat. Always returned in getChat.
    */
    public $accent_color_id;


    /**
    * @param String
    * Optional. Custom emoji identifier of emoji chosen by the chat for the reply header and link preview background. 
    * Returned only in getChat.
    */
    public $background_custom_emoji_id;

    /**
    * @param Integer
    * Optional. Identifier of the accent color for the chat's profile background.
    * See profile accent colors for more details. Returned only in getChat.
    */
    public $profile_accent_color_id;


    /**
    * @param String
    *  Optional. Custom emoji identifier of the emoji chosen by the chat for its profile background. 
    *  Returned only in getChat.
    */
    public $profile_background_custom_emoji_id;

    /**
    * @param String
    * Optional. Custom emoji identifier of the emoji status of the chat or the other party in a private chat. 
    * Returned only in getChat.
    */
    public $emoji_status_custom_emoji_id;

    /**
    * @param String
    * Optional. Bio of the other party in a private chat. Returned only in getChat.
    */
    public $bio;

    /**
    * @param Boolean True
    * Optional. True, if privacy settings of the other party in the private chat 
    * allows to use tg://user?id=<user_id> links only in chats with the user.
    * Returned only in getChat.
    */
    public $has_private_forwards;

    /**
    * @param Boolean True
    * Optional. True, if the privacy settings of the other party restrict 
    * sending voice and video note messages in the private chat. 
    * Returned only in getChat.
    */
    public $has_restricted_voice_and_video_messages;

    /**
    * @param Boolean True
    * Optional. True, if users need to join the supergroup before they can send messages. Returned only in getChat.
    */
    public $join_to_send_messages;

    /**
    *  @param Boolean True
    * Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators. 
    * Returned only in getChat.
    */
    public $join_by_request;

    /**
    *  @param Integer
    * Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds.
    * Returned only in getChat.
    */
    public $message_auto_delete_time;

    /**
    * @param Boolean True
    * Optional. True, if aggressive anti-spam checks are enabled in the supergroup. The field is only available to chat administrators. 
    * Returned only in getChat.
    */
    public $has_aggressive_anti_spam_enabled;

    /**
    * @param Boolean True
    * Optional. True, if non-administrators can only get the list of bots and administrators in the chat.
    * Returned only in getChat.
    */
    public $has_hidden_members;

    /**
    * @param Boolean True
    * Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
    */
    public $has_protected_content;

    /**
    * @param Integer
    * Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats.
    * This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it.
    * But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. 
    * Returned only in getChat.
    */
    public $linked_chat_id;

    /**
    * @param ChatLocation
    * Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
    */
    public $location;

    /**
     * Information about types of gifts that are accepted by the chat
     * or by the corresponding user for private chats.
     * @var aki\telegram\types\AcceptedGiftTypes|array
     */
    public $accepted_gift_types;

    /**
     * Optional. Community this chat belongs to (Bot API 10.2). Returned only in getChat / ChatFullInfo.
     * @var Community|array|null
     */
    public $community;

    /**
     * Optional. Guard bot for join request queries (Bot API 10.1)
     * @var User|array|null
     */
    public $guard_bot;

    /**
     * @param array|AcceptedGiftTypes $value
     */
    public function setAccepted_gift_types($value): void
    {
        $this->accepted_gift_types = $value instanceof AcceptedGiftTypes
            ? $value
            : new AcceptedGiftTypes($value);
    }

    /**
     * @param array|Community $value
     */
    public function setCommunity($value): void
    {
        $this->community = $value instanceof Community
            ? $value
            : new Community($value);
    }
}
