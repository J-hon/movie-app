<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface MovieContract extends BaseContract
{

    public function get(): Collection;

    public function getUserMovieList(int $userId): Collection;

}
