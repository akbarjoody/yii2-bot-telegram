<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object represents a live photo (photo with a short video). Bot API 10.0+
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class LivePhoto extends Type
{
    /** @var PhotoSize[]|array */
    public $photo;

    /** @var Video|array|null */
    public $video;

    public $file_id;

    public $file_unique_id;

    public $width;

    public $height;

    public $duration;
}
