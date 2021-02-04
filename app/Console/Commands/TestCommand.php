<?php

namespace App\Console\Commands;

use App\Helpers\StringHelper;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'llew:test';

    protected $description = 'For quick testing of methods';

    public function handle()
    {
        $this->idnumber = '690902 5062 080';

        $str = (new StringHelper($this->idnumber))->removeCharacter(' ');

        dd($str);
    }
}
