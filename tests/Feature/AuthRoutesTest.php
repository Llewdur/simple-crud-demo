<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthRoutesTest extends TestCase
{
    public function testInterestsNoAuth()
    {
        $this->get('/interests')->assertRedirect();
    }

    public function testInterestsLoggedIn()
    {
        $user = User::factory()->make();

        $this->actingAs($user)
            ->get('/interests')->assertOk();
    }

    public function testLanguagesNoAuth()
    {
        $this->get('/languages')->assertRedirect();
    }

    public function testLanguagesLoggedIn()
    {
        $user = User::factory()->make();

        $this->actingAs($user)
            ->get('/languages')->assertOk();
    }

    public function testUsersNoAuth()
    {
        $this->get('/users')->assertRedirect();
    }

    public function testUsersLoggedIn()
    {
        $user = User::factory()->make();

        $this->actingAs($user)
            ->get('/users')->assertOk();
    }
}
