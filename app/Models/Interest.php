<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    public const RESPONSE_ARRAY = [
        'id',
        'created_at',
        'name',
        'updated_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function user_interest()
    {
        return $this->hasMany(UserInterest::class);
    }
}
