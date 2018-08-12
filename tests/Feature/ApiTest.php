<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\ExecutionDate;
use App\Models\Job;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
    }

    public function testExecutionDates()
    {
        $executionDate = factory(ExecutionDate::class)->create();

        $response = $this->call('get', route('api.execution_dates'));

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'success',
            'execution_dates' => [
                '*' => [
                    'id', 'title'
                ]
            ]
        ]);
        $response->assertJsonFragment(['title' => $executionDate->title]);
    }

    public function testCategories()
    {
        $parentCategory = factory(Category::class)->create();
        $category = factory(Category::class)->create();
        $category->update([
            'parent_id' => $parentCategory->id
        ]);

        $response = $this->call('get', route('api.categories'));

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'success',
            'categories' => [
                '*' => [
                    'id', 'name'
                ]
            ]
        ]);
        $response->assertJsonFragment([
            'name' => $parentCategory->name,
            'parent_id' => null,
        ]);

        $response->assertJsonFragment([
            'name' => $category->name,
            'parent_id' => $category->parent->id,
        ]);
    }

    public function testCity()
    {
        $city = factory(City::class)->create();

        $response = $this->call('get', route('api.city'), [
            'zip' => $city->zip
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'success',
            'city' => [
                'id', 'name'
            ]
        ]);
    }

    public function testStoreJob()
    {
        $city = factory(City::class)->create();
        $category = factory(Category::class)->create();
        $executionDate = factory(ExecutionDate::class)->create();
        $title = Str::random(10);
        $description = Str::random(100);

        $response = $this->call('post', route('api.jobs.create'), [
            'city_id' => $city->id,
            'title' => $title,
            'category_id' => $category->id,
            'description' => $description,
            'execution_date_id' => $executionDate->id
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('jobs', [
            'city_id' => $city->id,
            'title' => $title,
            'category_id' => $category->id,
            'description' => $description,
            'execution_date_id' => $executionDate->id
        ]);
    }
}
