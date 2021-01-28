<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public const RESPONSE_ARRAY = [
        'id',
        'code',
        'name',
    ];

    // public static array $rules = [
    //     'code' => 'required|string|min:1|max:10|unique:languages,id,:id',
    //     'name' => 'required|string|min:3|max:255|unique:languages,id,:id',
    // ];

    protected $fillable = [
        'code',
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
