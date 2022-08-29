<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => env('IMAGE_URL') . 'news/' . $this->image,
            'slug' => $this->slug,
            'created_at' => $this->created_at->diffForHumans(),
        );
    }
}
