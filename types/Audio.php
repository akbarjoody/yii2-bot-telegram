<?php
namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object represents an audio file to be treated as music by the Telegram clients.
 */
class Audio extends Type
{
    public $file_id;
    
    public $file_name;
    
    public $file_unique_id;

    public $duration;

    public $performer;

    public $title;

    public $mime_type;

    public $file_size;

    public $thumb;

    public $thumbnail;
}