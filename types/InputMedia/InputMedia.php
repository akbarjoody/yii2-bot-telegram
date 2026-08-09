<?php
namespace aki\telegram\types\InputMedia;

use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object represents the content of a media message to be sent. It should be one of
 * InputMediaAnimation
 * InputMediaDocument
 * InputMediaAudio
 * InputMediaPhoto
 * InputMediaVideo
 * InputMediaLivePhoto
 * InputMediaVoiceNote
 */
class InputMedia extends Type{
    public $media;
}
