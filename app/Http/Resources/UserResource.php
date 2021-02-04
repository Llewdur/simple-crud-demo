<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'dob' => $this->dob,
            'email' => $this->email,
            'idnumber' => $this->idnumber,
            'language_id' => $this->language_id,
            // 'interests' => $this->interests,
            'mobile' => $this->mobile,
            'name' => $this->name,
            'surname' => $this->surname,
            'updated_at' => $this->updated_at,
        ];
    }
}
