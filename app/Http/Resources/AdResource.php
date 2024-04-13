<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
        $response = [
            'id' =>$this->id, 
            'name' => $this->name,
            'price' => $this->price,
            'main_photo' => PhotoResource::collection($this->photos)?->first(),
            "created_at" => $this->created_at,
        ];

        if ($request->has('fields')) {
            $fields = explode(',', $request->get('fields'));

            if (in_array('description', $fields)) {
                $response['description'] = $this->description;
            }

            if (in_array('all_photos', $fields)) {
                $response['all_photos'] = PhotoResource::collection($this->photos);
            }
        }

        return $response;
    }
}
