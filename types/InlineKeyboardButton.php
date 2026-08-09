<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object represents one button of an inline keyboard.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class InlineKeyboardButton extends Type
{
    public $text;

    public $url;

    public $login_url;

    public $callback_data;

    public $web_app;

    public $switch_inline_query;

    public $switch_inline_query_current_chat;

    public $switch_inline_query_chosen_chat;

    public $copy_text;

    public $callback_game;

    public $pay;

    /** @var string|null Custom emoji on the button (Bot API 9.4) */
    public $icon_custom_emoji_id;

    /** @var string|null Button color style (Bot API 9.4) */
    public $style;
}
