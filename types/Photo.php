<?php
namespace aki\telegram\types;


use aki\telegram\base\Type;

/**
 * 
 */
class Photo extends Type
{
    public $photoSize = [];

    public function __construct($config = [])
    {
        if (!is_array($config)) {
            return;
        }
        foreach ($config as $attribute) {
            if (is_array($attribute)) {
                $this->photoSize[] = new PhotoSize($attribute);
            }
        }
    }

}