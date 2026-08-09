<?php /** @noinspection PhpUnused */

namespace aki\telegram\types\InputMedia;

/**
 * Represents a live photo to be sent. Bot API 10.0+
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class InputMediaLivePhoto extends InputMedia
{
    public $type = 'live_photo';

    public $media;

    public $caption = '';

    public $parse_mode = '';

    /** @var array|null */
    public $caption_entities;

    public $show_caption_above_media;

    public $has_spoiler;
}
