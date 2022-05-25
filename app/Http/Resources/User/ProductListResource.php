<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = "name_".app()->getLocale();
        return [
            'id' => $this->id,
            'name' => $this->$name,
            'category_id' => $this->category_id,
            'category_name' => $this->category->$name,
        ];
    }
}
