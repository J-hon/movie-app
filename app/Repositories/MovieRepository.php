<?php

namespace App\Repositories;

use App\Contracts\MovieContract;
use App\Models\Movie;
use Illuminate\Support\Collection;

class MovieRepository extends BaseRepository implements MovieContract
{

    public function __construct(Movie $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function get(): Collection
    {
        return $this->with('genres:id,name')->orderBy('release_date')->get();
    }

    public function getUserMovieList(int $userId): Collection
    {
        return $this->getQuery()
            ->whereHas('users', fn ($query) => $query->where('users.id', '=', $userId))
            ->get();
    }

}
