<?php

namespace Tests\Feature\Authentication;

use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class SignupTest extends TestCase
{

    public function test_email_is_required()
    {
        $this->expectException(ValidationException::class);

        $response = $this->postJson("$this->baseUrl/auth/signup", ['password' => $this->faker->password(8)]);
        $response->assertStatus(422)
                ->assertJsonValidationErrors([
                    'email'
                ]);
    }

    public function test_password_is_required()
    {
        $this->expectException(ValidationException::class);

        $response = $this->postJson("$this->baseUrl/auth/signup", ['email' => $this->faker->email]);
        $response->assertStatus(422)
                ->assertJsonValidationErrors([
                    'password'
                ]);
    }

    public function test_email_and_password_is_required()
    {
        $this->expectException(ValidationException::class);

        $response = $this->postJson("$this->baseUrl/auth/signup");
        $response->assertStatus(422)
                ->assertJsonValidationErrors([
                    'email',
                    'password'
                ]);
    }

    public function test_user_can_create_account()
    {
        $payload = [
            'name'     => $this->faker->firstName . ' ' . $this->faker->lastName,
            'email'    => $this->faker->email,
            'password' => 'Asecretpass1@'
        ];
        $response = $this->postJson("$this->baseUrl/auth/signup", $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name'  => $payload['name'],
            'email' => $payload['email']
        ]);
    }
}
