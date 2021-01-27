<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public const TESTS_EMAIL = 'llewellyn@zekini.com';

    public const TESTS_NAME = 'Llewellyn';

    public const TESTS_PASSWORD = '12345678';

    public const TESTS_SURNAME = 'du Randt';

    public const TESTS_MOBILE = '083 445 2207';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function userInterests()
    {
        return $this->hasManyThrough(Interest::class, UserInterest::class);
    }
}
