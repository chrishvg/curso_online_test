<?php

namespace Tests\Feature\Courses;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;

class CourseControllerTest extends TestCase
{
    public function test_store_creates_course_and_redirects()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $category = Category::factory()->create();
        $admin->roles()->attach($role);
        $faker = Faker::create();

        $response = $this->actingAs($admin)->post(route('course.store'), [
            'name' => $faker->word() . rand(1, 100),
            'category_id' => $category->id,
            'age_group' => $faker->randomElement(['5-8', '9-13', '14-16', '16+']),
            'description' => $faker->word()
        ]);

        $role->fresh();
        $admin->fresh();
        $category->fresh();

        $response->assertRedirect(route('course'));
    }

    public function test_index_returns_courses_and_categories()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $category = Category::factory()->create();
        $courses = Course::factory()->count(3)->create(['category_id' => $category->id]);
        $response = $this->actingAs($admin)->get(route('course'));
        $response->assertViewIs('course.index');

        $courses->each(function ($course) use ($category) {
            $this->assertEquals($category->id, $course->category->id);  // Verificar que cada curso tiene la categoría correcta
        });
    }
}
