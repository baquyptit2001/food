<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TinhResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array(
            'id' => str_pad($this->matp, 2, '0', STR_PAD_LEFT),
            'name' => $this->name,
            'quan' => QuanResource::collection($this->quan),
        );
    }
}
