<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Contracts\Auth\Authenticatable;

class MovieService
{

    public function get(): array
    {
        $response = Movie::with('genres:id,name')->get();
        return [
            'status'  => true,
            'message' => 'Movies retrieved!',
            'code'    => 200,
            'data'    => $response
        ];
    }

    public function addToMovieList(Authenticatable $user, array $params): array
    {
        if ($user->movies()->where('movie_id', '=', $params['movie_id'])->exists()) {
            return [
                'status'  => false,
                'message' => 'Movie already in list!',
                'code'    => 400,
                'data'    => []
            ];
        }

        if ($user->movies()->count() >= 10) {
            return [
                'status'  => false,
                'message' => 'Oops! Movie list is full! You can only add a maximum of 10 movies to your list',
                'code'    => 400,
                'data'    => []
            ];
        }

        $user->movies()->syncWithoutDetaching($params);
        return [
            'status'  => true,
            'message' => 'Movie added to list!',
            'code'    => 200,
            'data'    => []
        ];
    }

    public function removeFromMovieList(Authenticatable $user, array $params): array
    {
        if (!$user->movies()->where('movie_id', '=', $params['movie_id'])->exists()) {
            return [
                'status'  => false,
                'message' => 'Movie not found in your list!',
                'code'    => 400,
                'data'    => []
            ];
        }

        $user->movies()->detach($params);
        return [
            'status'  => true,
            'message' => 'Movie added to list!',
            'code'    => 200,
            'data'    => []
        ];
    }

}
