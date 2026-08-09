<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object contains information about one answer option in a poll.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class PollOption extends Type
{
    public $text;

    /** @var array|null MessageEntity[] */
    public $text_entities;

    public $voter_count;

    /** @var string|null Persistent option id (Bot API 9.6) */
    public $persistent_id;

    /** @var array|null */
    public $media;

    /** @var User|array|null */
    public $added_by_user;

    /** @var Chat|array|null */
    public $added_by_chat;

    /** @var Integer|null */
    public $addition_date;
}
