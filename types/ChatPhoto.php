<?php

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * This object represents a chat photo.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class ChatPhoto extends Type
{
    public $small_file_id;

    public $small_file_unique_id;

    public $big_file_id;

    public $big_file_unique_id;
}
