<?php

namespace aki\telegram\base;

use yii\base\Component;
use yii\base\UnknownPropertyException;

/**
 * Base type for Telegram Bot API objects.
 *
 * Unknown properties from newer Bot API fields are ignored so hydration
 * does not break when Telegram adds fields the library has not declared yet.
 */
class Type extends Component
{
    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        try {
            parent::__set($name, $value);
        } catch (UnknownPropertyException $e) {
            // Ignore undeclared Telegram API fields.
        }
    }
}
