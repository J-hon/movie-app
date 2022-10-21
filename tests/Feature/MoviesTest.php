<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Tests\TestCase;

class MoviesTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->user  = $this->authenticate(User::factory()->create());
    }

    public function test_user_can_add_movie_to_list()
    {
        $movie = Movie::factory()->create();

        $this->postJson("$this->baseUrl/movies/list/add", ['movie_id' => $movie->id])->assertStatus(200);

        $this->assertDatabaseHas('movie_lists', [
            'user_id'  => $this->user->id,
            'movie_id' => $movie->id
        ]);
    }

    public function test_user_cant_add_same_movie_to_list()
    {
        $movie = Movie::factory()->create();

        $this->user->movies()->attach($movie->id);

        $this->postJson("$this->baseUrl/movies/list/add", ['movie_id' => $movie->id])->assertStatus(400);
    }

    public function test_user_cant_add_more_than_ten_movies_to_list()
    {
        $movie = Movie::factory()->create();

        $this->user->movies()->attach(Movie::factory(10)->create()->pluck('id')->toArray());

        $this->postJson("$this->baseUrl/movies/list/add", ['movie_id' => $movie->id])->assertStatus(400);
    }

    public function test_user_can_remove_movie_from_list()
    {
        $movie = Movie::factory()->create();

        $this->user->movies()->attach($movie->id);

        $this->deleteJson("$this->baseUrl/movies/list/remove/$movie->id")->assertStatus(200);

        $this->assertDatabaseMissing('movie_lists', [
            'user_id'  => $this->user->id,
            'movie_id' => $movie->id
        ]);
    }

    public function test_user_cant_remove_non_existing_movie_from_list()
    {
        $movie = Movie::factory()->create();

        $this->deleteJson("$this->baseUrl/movies/list/remove/$movie->id")->assertStatus(400);
    }
}
