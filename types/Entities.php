<?php
namespace aki\telegram\types;


use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * 
 */
class Entities extends Type
{
    public $entities = [];

    public function __construct($config = [])
    {
        if (!is_array($config)) {
            return;
        }
        foreach ($config as $attribute) {
            if (is_array($attribute)) {
                $this->entities[] = new Entitie($attribute);
            }
        }
    }

}