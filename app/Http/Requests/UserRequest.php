<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dob' => 'required|date|date_format:Y-m-d|before:today',
            'email' => 'required|email|min:3|max:255|unique:users,email,' . $this->id,
            'idnumber' => 'required|string|min:3|max:11|unique:users,idnumber,' . $this->id,
            'language_id' => 'required|integer|exists:languages,id',
            'mobile' => 'required|string|min:9|max:11',
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
        ];
    }
}
