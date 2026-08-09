<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * Alias of User used historically for message.from / callback.from.
 * Kept for backward compatibility; mirrors User fields.
 */
class From extends Type
{
    public $id;

    public $update_id;

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

    public $has_topics_enabled;

    public $allows_users_to_create_topics;

    public $can_manage_bots;

    public $supports_guest_queries;

    public $supports_join_request_queries;
}
