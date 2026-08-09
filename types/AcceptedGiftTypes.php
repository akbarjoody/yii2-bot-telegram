<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object describes the types of gifts that can be gifted to a user or a chat.
 */
class AcceptedGiftTypes extends Type
{
    /**
     * True, if unlimited regular gifts are accepted
     * @var Boolean
     */
    public $unlimited_gifts;

    /**
     * True, if limited regular gifts are accepted
     * @var Boolean
     */
    public $limited_gifts;

    /**
     * True, if unique gifts or gifts that can be upgraded to unique for free are accepted
     * @var Boolean
     */
    public $unique_gifts;

    /**
     * True, if a Telegram Premium subscription is accepted
     * @var Boolean
     */
    public $premium_subscription;

    /**
     * True, if transfers of unique gifts from channels are accepted
     * @var Boolean
     */
    public $gifts_from_channels;
}
