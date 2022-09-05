<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuanResource extends JsonResource
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
            'id' => str_pad($this->maqh, 3, '0', STR_PAD_LEFT),
            'name' => $this->name,
//            'tinh' => TinhResource::make($this->tinh),
            'xa' => XaResource::collection($this->xa),
        );
    }
}
