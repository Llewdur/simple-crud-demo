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

    public const TESTS_MOBILE = '27834452207';

    public const RESPONSE_ARRAY = [
        'id',
        'created_at',
        'dob',
        'email',
        'idnumber',
        'language_id',
        'mobile',
        'name',
        'surname',
        'updated_at',
    ];

    protected $fillable = [
        'dob',
        'email',
        'email_verified_at',
        'idnumber',
        'language_id',
        'mobile',
        'name',
        'password',
        'surname',
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

    public function interests()
    {
        return $this->belongsToMany(Interest::class);
    }
}
