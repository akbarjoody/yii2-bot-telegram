<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class ChatPermissions extends Type
{
    public $can_send_messages;

    /**
     * @deprecated Use can_send_audios, can_send_documents, can_send_photos, can_send_videos, can_send_video_notes, can_send_voice_notes
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

    public $can_change_info;

    public $can_invite_users;

    public $can_pin_messages;

    public $can_manage_topics;

    /** @var Boolean|null Bot API 9.5 */
    public $can_edit_tag;

    /** @var Boolean|null Bot API 10.0 */
    public $can_react_to_messages;
}
