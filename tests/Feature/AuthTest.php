<?php


// Use the RefreshDatabase trait to keep your test DB clean

use App\Dao\Models\Core\User;
use App\Models\Category;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

describe('login', function () {

    it('allows an existing user to log in', function () {
        // 1. Arrange: Create a user
        $user = User::factory()->create([
            'password' => bcrypt('secret-password'),
        ]);

        // 2. Act: Hit the login endpoint
        $response = $this->post('/login', [
            'login' => $user->username,
            'password' => 'secret-password',
        ]);

        // 3. Assert: Check the outcome
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    });

});
