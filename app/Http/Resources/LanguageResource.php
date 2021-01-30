<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'created_at' => $this->created_at,
            'name' => $this->name,
            'updated_at' => $this->updated_at,
        ];
    }
}
