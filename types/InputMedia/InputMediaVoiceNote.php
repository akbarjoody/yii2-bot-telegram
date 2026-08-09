<?php

namespace aki\telegram\types\InputMedia;

/**
 * Represents a voice note to be sent inside rich messages / polls. Bot API 10.2+
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class InputMediaVoiceNote extends InputMedia
{
    public $type = 'voice_note';

    public $media;

    public $caption = '';

    public $parse_mode = '';

    /** @var array|null */
    public $caption_entities;

    public $duration;
}
