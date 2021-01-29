<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class TestCommand extends Command
{

    protected $signature = 'TestCommand';
    protected $description = 'For quick testing of methods';

    public function handle()
    {
        $sendDate = '2021-01-28 07:00';
        dd(
            Carbon::createFromFormat('Y-m-d H:i:s', $sendDate)
        );
    }
}
