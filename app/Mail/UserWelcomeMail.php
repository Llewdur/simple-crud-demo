<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserWelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    protected User $user;

    protected $type;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.user-welcome')
            ->with([
                'name' => $this->user->name,
            ]);
    }
}
