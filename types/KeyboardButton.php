<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object represents one button of the reply keyboard.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class KeyboardButton extends Type
{
    public $text;

    public $request_users;

    public $request_chat;

    public $request_contact;

    public $request_location;

    public $request_poll;

    public $web_app;

    /** @var array|null Bot API 9.6 */
    public $request_managed_bot;

    /** @var string|null Custom emoji on the button (Bot API 9.4) */
    public $icon_custom_emoji_id;

    /** @var string|null Button color style (Bot API 9.4) */
    public $style;
}
