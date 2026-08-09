<?php
namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 */
class Document extends Type
{
    public $file_id;

    public $file_unique_id;

    private $_thumb;

    private $_thumbnail;

    public $file_name;

    public $mime_type;

    public $file_size;
    
    public function getThumb()
    {
        return $this->_thumb;
    }

    public function setThumb($value)
    {
        $this->_thumb = new PhotoSize($value);
    }

    public function getThumbnail()
    {
        return $this->_thumbnail;
    }

    public function setThumbnail($value)
    {
        $this->_thumbnail = new PhotoSize($value);
    }
}