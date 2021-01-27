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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function user_interest()
    {
        return $this->hasMany(UserInterest::class);
    }
}
