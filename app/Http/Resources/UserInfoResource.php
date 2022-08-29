<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'receiver' => $this->receiver,
            'address' => $this->address,
            'phone' => $this->phone,
            'is_default' => $this->is_default,
            'tinh' => new TinhResource($this->tinh),
            'quan' => new QuanResource($this->quan),
            'xa' => new XaResource($this->xa),
            'address_full' => $this->xa->name . ', ' . $this->quan->name . ', ' . $this->tinh->name,
        ];
    }
}
