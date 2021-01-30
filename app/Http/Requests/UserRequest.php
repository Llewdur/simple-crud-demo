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
            'idnumber' => 'required|numeric|digits:13|unique:users,idnumber,' . $this->id,
            'language_id' => 'required|integer|exists:languages,id',
            'mobile' => 'required|numeric|digits:11',
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'mobile' => str_replace('+', '', str_replace(' ', '', $this->mobile)),
            'idnumber' => str_replace(' ', '', $this->idnumber),
        ]);
    }
}
