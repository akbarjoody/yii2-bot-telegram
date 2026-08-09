<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object represents a Telegram user or bot.
 * Updated for Bot API 10.2 fields used by getMe and message senders.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class User extends Type
{
    public $id;

    public $is_bot;

    public $first_name;

    public $last_name;

    public $username;

    public $language_code;

    public $is_premium;

    public $added_to_attachment_menu;

    public $can_join_groups;

    public $can_read_all_group_messages;

    public $supports_inline_queries;

    public $can_connect_to_business;

    public $has_main_web_app;

    /** @var Boolean|null Topics enabled in private chats with the bot (Bot API 9.3) */
    public $has_topics_enabled;

    /** @var Boolean|null Users may create topics in private chat (Bot API 9.4) */
    public $allows_users_to_create_topics;

    /** @var Boolean|null Bot can manage other bots (Bot API 9.6) */
    public $can_manage_bots;

    /** @var Boolean|null Supports guest queries (Bot API 10.0) */
    public $supports_guest_queries;

    /** @var Boolean|null Supports join request queries (Bot API 10.1) */
    public $supports_join_request_queries;
}
