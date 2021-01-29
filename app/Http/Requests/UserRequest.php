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
            'code' => 'required|string|min:1|max:10|unique:languages,code,' . $this->id,
            'name' => 'required|string|min:3|max:255|unique:languages,name,' . $this->id,
        ];
    }
}
