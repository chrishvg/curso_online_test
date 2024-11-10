<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Video;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_for_admin_returns_correct_data()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $categories = Category::factory()->count(3)->create();
        $courses = Course::factory()->count(3)->create(['category_id' => $categories->random()->id]);
        $videos = Video::factory()->count(3)->create(['course_id' => $courses->random()->id]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertViewIs('dashboard');

        $response->assertViewHas('users');
        $response->assertViewHas('courses', $courses);
        $response->assertViewHas('videos', $videos);
        $response->assertViewHas('categories', $categories);

        $courses->each(function ($course) {
            $this->assertNotNull($course->category);
        });

        $videos->each(function ($video) {
            $this->assertNotNull($video->course);
        });
    }

    public function test_dashboard_for_regular_user_returns_correct_data()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);

        $categories = Category::factory()->count(3)->create();
        $courses = Course::factory()->count(3)->create(['category_id' => $categories->random()->id]);
        $user->courses()->attach($courses->pluck('id'));

        $allCourses = Course::factory()->count(5)->create(['category_id' => $categories->random()->id]);

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertViewIs('user.dashboard');
        $response->assertViewHas('allCourses', $allCourses);
        $response->assertViewHas('courses', $user->courses);
        $response->assertViewHas('categories', $categories);

        $user->courses->each(function ($course) {
            $this->assertTrue($course->users->contains('id', $course->pivot->user_id));
        });

        $allCourses->each(function ($course) use ($user) {
            $this->assertFalse($course->users->contains('id', $user->id));
        });
    }
}
