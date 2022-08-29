<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class XaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array(
            'id' => $this->maqh,
            'name' => $this->name,
//            'quan' => QuanResource::make($this->quan),
        );
    }
}
