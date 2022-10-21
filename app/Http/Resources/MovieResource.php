<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'id'             => $this->id,
            'title'          => $this->title,
            'overview'       => $this->overview,
            'release_date'   => $this->release_date,
            'image'          => 'https://image.tmdb.org/t/p/w500'.$this->image,
            'exists_in_list' => $this->isInMovieList(),
            'genres'         => $this->genres->map(fn ($genre) => $genre->name)
        ];
    }

    private function isInMovieList(): bool
    {
        return $this->users()->where('user_id', '=', Auth::id())->exists();
    }
}
