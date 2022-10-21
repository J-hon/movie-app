<?php

namespace App\Services;

use App\Contracts\MovieContract;
use App\Contracts\UserContract;

class MovieService
{

    public function __construct(
        protected MovieContract $movieRepository,
        protected UserContract  $userRepository
    ) {
    }

    public function get(): array
    {
        $response = $this->movieRepository->get();
        return [
            'status'  => true,
            'message' => 'Movies retrieved!',
            'code'    => 200,
            'data'    => $response
        ];
    }

    public function getMovieList(int $userId): array
    {
        $response = $this->movieRepository->getUserMovieList($userId);
        return [
            'status'  => true,
            'message' => 'Movie list retrieved!',
            'code'    => 200,
            'data'    => $response
        ];
    }

    public function addToMovieList(int $userId, array $params): array
    {
        $this->userRepository->addToMovieList($userId, $params['movie_id']);
        return [
            'status'  => true,
            'message' => 'Movie added to list!',
            'code'    => 200,
            'data'    => []
        ];
    }

    public function removeFromMovieList(int $userId, int $movieId): array
    {
        $this->userRepository->removeFromMovieList($userId, $movieId);
        return [
            'status'  => true,
            'message' => 'Movie removed from list!',
            'code'    => 200,
            'data'    => []
        ];
    }

}
