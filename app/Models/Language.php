<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public const RESPONSE_ARRAY = [
        'id',
        'created_at',
        'code',
        'name',
        'updated_at',
    ];

    protected $fillable = [
        'code',
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
