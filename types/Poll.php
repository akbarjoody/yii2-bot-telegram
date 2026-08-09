<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object contains information about a poll.
 * Updated for Bot API 9.6–10.1 poll features.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class Poll extends Type
{
    public $id;

    public $question;

    /** @var array|null MessageEntity[] */
    public $question_entities;

    /** @var PollOption[]|array */
    public $options;

    public $total_voter_count;

    public $is_closed;

    public $is_anonymous;

    public $type;

    public $allows_multiple_answers;

    /**
     * @deprecated Bot API 9.6 — use correct_option_ids
     * @var Integer|null
     */
    public $correct_option_id;

    /** @var int[]|null Multiple correct answers (Bot API 9.6) */
    public $correct_option_ids;

    public $explanation;

    /** @var array|null */
    public $explanation_entities;

    public $open_period;

    public $close_date;

    public $allows_revoting;

    public $description;

    /** @var array|null */
    public $description_entities;

    /** @var array|null Poll media (Bot API 10.0) */
    public $media;

    /** @var array|null */
    public $explanation_media;

    public $members_only;

    /** @var string[]|null */
    public $country_codes;
}
