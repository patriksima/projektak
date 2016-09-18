<?php

namespace App\Libraries;

/**
 * Token class.
 */
class Token
{
    public $name;
    public $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
