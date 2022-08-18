<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => env('IMAGE_URL') . 'news/' . $this->image,
            'slug' => $this->slug,
            'created_at' => date('d/m/Y', strtotime($this->created_at)),
        );
    }
}
