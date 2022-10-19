<?php

namespace App\Services;

use App\Models\Movie;

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

}
