<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type == 0 ? 'free' : 'paid',
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'category' => $this->category->name ?? null,
            'advertiser' => $this->advertiser->name ?? null,
            
        ];
    }
}