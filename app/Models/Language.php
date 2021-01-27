<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public static array $rules = [
        'code' => 'required|string|min:1|max:255|unique:languages',
        'name' => 'required|string|min:3|max:255|unique:languages',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
