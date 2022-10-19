<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class MoviesTableSeeder extends Seeder
{

    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.themoviedb.org/3';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies      = [];
        $movieGenres = [];
        $response    = Http::get("$this->baseUrl/movie/top_rated?api_key=".config('services.tmdb.api_key'))->json();

        foreach($response['results'] as $movie) {
            $movies[] = [
                'id'           => $movie['id'],
                'title'        => $movie['title'],
                'overview'     => $movie['overview'],
                'image'        => $movie['poster_path'],
                'release_date' => $movie['release_date'],
                'created_at'   => now(),
                'updated_at'   => now()
            ];

            foreach ($movie['genre_ids'] as $genreId) {
                $movieGenres[] = [
                    'genre_id'  => $genreId,
                    'movie_id'  => $movie['id']
                ];
            }
        }

        Schema::disableForeignKeyConstraints();

        DB::table('genre_movie')->truncate();
        DB::table('movies')->truncate();

        DB::table('movies')->insert($movies);
        DB::table('genre_movie')->insert($movieGenres);

        Schema::enableForeignKeyConstraints();
    }
}
