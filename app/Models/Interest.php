<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    public static array $rules = [
        'name' => 'required|string|min:3|max:255|unique:interests',
    ];

    protected $fillable = [
        'name',
    ];

    public function user_interest()
    {
        return $this->hasMany(UserInterest::class);
    }
}
