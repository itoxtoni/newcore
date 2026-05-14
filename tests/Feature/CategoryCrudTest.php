<?php


// Use the RefreshDatabase trait to keep your test DB clean

use App\Dao\Models\Core\User;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AccessMiddleware;
use App\Models\Category;
use Buki\AutoRoute\AutoRouteFacade as AutoRoute;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

describe('Category CRUD', function () {

    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->seed();

        AutoRoute::auto('category', CategoryController::class, [
            'name' => 'category',
            'middleware' => AccessMiddleware::class
        ]);
    });

    it('allows an authenticated user to create and update a category', function () {
        // 1. Arrange
        $categoryName = fake()->word();

        // 2. Act
        $response = $this->actingAs($this->user)
        ->post('category/create', [
            'category_nama' => $categoryName, // Make sure this matches your Controller validation
        ]);

        // 3. Assert
        $response->assertRedirect();

        // Fetch the category from the DB to verify it exists
        $category = Category::where('category_nama', $categoryName)->first();

        // Check if $category is null before reading property
        expect($category)->not->toBeNull();
        expect($category->field_name)->toBe($categoryName);

        $this->assertDatabaseHas('category', [
            'category_nama' => $categoryName
        ]);

        $newName = 'Updated Category Name';

        $response = $this->actingAs($this->user)
            ->post("category/update/{$category->field_primary}", [
                'category_nama' => $newName,
            ]);

        // 3. Assert
        $response->assertRedirect();

        // Refresh the model from the DB to get new data
        $category->refresh();
        expect($category->category_nama)->toBe($newName);

        $this->assertDatabaseHas('category', [
            'category_id' => $category->field_primary,
            'category_nama' => $newName
        ]);

        // 2. Act: Send a DELETE request
        $response = $this->actingAs($this->user)
            ->get("category/delete?code={$category->field_primary}");

        // 3. Assert
        $response->assertRedirect();

        // Verify it is gone from the database
        $this->assertDatabaseMissing('category', [
            'category' => $category->field_primary
        ]);

    });

});
