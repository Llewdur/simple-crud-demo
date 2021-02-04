<?php

namespace App\Helpers;

class StringHelper
{
    public $string;

    public function __construct(?String $string = '')
    {
        $this->string = $string;
    }

    public function removeCharacter(String $character): self
    {
        $this->string = str_replace($character, '', $this->string);

        return $this;
    }

    public function toString(): string
    {
        return $this->string;
    }
}
