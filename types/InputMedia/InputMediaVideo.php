<?php
namespace aki\telegram\types\inputMedia;


use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * Represents a video to be sent.
 */
class InputMediaVideo extends Type implements InputMedia
{
    public $type;

    public $media;
    
    public $thumb;

    public $caption;

    public $parse_mode;

    public $width;

    public $height;

    public $duration;

    public $supports_streaming;
}