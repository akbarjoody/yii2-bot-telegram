<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * Describes reply parameters for outgoing messages.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class ReplyParameters extends Type
{
    /** Optional when ephemeral_message_id is set (Bot API 10.2) */
    public $message_id;

    public $chat_id;

    public $allow_sending_without_reply;

    public $quote;

    public $quote_parse_mode;

    /** @var array|null */
    public $quote_entities;

    public $quote_position;

    /** @var Integer|null Reply to a poll option (Bot API 9.6) */
    public $poll_option_id;

    /** @var Integer|string|null Reply to an ephemeral message (Bot API 10.2) */
    public $ephemeral_message_id;
}
