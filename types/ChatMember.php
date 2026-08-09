<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object contains information about one member of a chat.
 * Covers common fields across ChatMember* statuses.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class ChatMember extends Type
{
    /** @var User|array */
    public $user;

    public $status;

    public $custom_title;

    public $until_date;

    public $can_be_edited;

    public $is_anonymous;

    public $can_manage_chat;

    public $can_post_messages;

    public $can_edit_messages;

    public $can_delete_messages;

    public $can_post_stories;

    public $can_edit_stories;

    public $can_delete_stories;

    public $can_manage_video_chats;

    public $can_restrict_members;

    public $can_promote_members;

    public $can_change_info;

    public $can_invite_users;

    public $can_pin_messages;

    public $can_manage_topics;

    public $can_manage_tags;

    public $is_member;

    public $can_send_messages;

    /**
     * @deprecated
     */
    public $can_send_media_messages;

    public $can_send_audios;

    public $can_send_documents;

    public $can_send_photos;

    public $can_send_videos;

    public $can_send_video_notes;

    public $can_send_voice_notes;

    public $can_send_polls;

    public $can_send_other_messages;

    public $can_add_web_page_previews;

    public $can_manage_topics_member;

    /** @var string|null Member tag (Bot API 9.5) */
    public $tag;

    public $can_edit_tag;

    public $can_react_to_messages;
}
