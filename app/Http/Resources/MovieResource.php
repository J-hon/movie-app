<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'overview'     => $this->overview,
            'release_date' => $this->release_date,
            'image'        => 'https://image.tmdb.org/t/p/w500'.$this->image,
            'genres'       => $this->genres
        ];
    }
}
