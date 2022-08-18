<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $postFix = '';
        if ($this->maximum_uses != null) {
            $postFix = ' (' . round($this->used / $this->maximum_uses) . '%)';
        }
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'discount' => $this->discount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'minimum_price' => $this->minimum_price,
            'maximum_discount' => $this->maximum_discount,
            'maximum_uses' => $this->maximum_uses,
            'type_text' => $this->type ? ' VND' : '%',
            'type' => $this->type,
            'used' => $this->used . $postFix,
            'status' => ($this->maximum_uses and $this->used >= $this->maximum_uses) ? 0 : 1,
            'status_text' => ($this->maximum_uses and $this->used >= $this->maximum_uses) ? 'Không khả dụng' : 'Có thể sử dụng',
        );
    }
}
