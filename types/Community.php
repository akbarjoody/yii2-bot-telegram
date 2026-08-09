<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * Represents a Telegram Community (Bot API 10.2).
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class Community extends Type
{
    public $id;

    public $title;

    public $username;

    public $description;

    /** @var ChatPhoto|array|null */
    public $photo;

    /** @var Integer|null */
    public $member_count;
}
