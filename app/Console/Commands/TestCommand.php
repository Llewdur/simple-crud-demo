<?php

namespace App\Console\Commands;

use App\Jobs\UserStoreJob;
use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'TestCommand';

    protected $description = 'For quick testing of methods';

    public function handle()
    {
        if (! $user = User::where('email', 'support@zekini.com')->first()) {
            $user = User::where('id', '!=', 1)->inRandomOrder()->firstOrFail();

            $user->update([
                'email' => 'support@zekini.com',
            ]);
        }

        $user = User::inRandomOrder()->firstOrFail();

        UserStoreJob::dispatch($user)->onQueue('default');
    }
}
