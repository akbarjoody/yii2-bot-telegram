<?php
namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object represents a video file.
 */
class Video extends Type
{
    public $file_id;

    public $file_unique_id;

    public $file_name;

    public $width;

    public $height;

    public $duration;

    public $thumb;

    public $thumbnail;

    public $mime_type;

    public $file_size;
}
