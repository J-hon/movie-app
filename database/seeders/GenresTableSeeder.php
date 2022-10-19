<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class GenresTableSeeder extends Seeder
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
        $genres   = [];
        $response = Http::get("$this->baseUrl/genre/movie/list?api_key=".config('services.tmdb.api_key')."&language=en-US")->json();

        foreach ($response['genres'] as $genre) {
            $genres[] = [
                'id'         => $genre['id'],
                'name'       => $genre['name'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Schema::disableForeignKeyConstraints();

        DB::table('genres')->truncate();
        DB::table('genres')->insert($genres);

        Schema::enableForeignKeyConstraints();
    }
}
