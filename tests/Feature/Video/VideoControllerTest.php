<?php

namespace Tests\Feature\Video;

use App\Models\User;
use App\Models\Video;
use App\Models\Course;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_for_admin_returns_all_videos_and_courses()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $response = $this->actingAs($admin)->get(route('videos'));

        $response->assertViewIs('video.index');
    }

    public function test_index_for_non_admin_returns_noallowed_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('videos'));

        $response->assertViewIs('noallowed');
    }

    public function test_store_creates_video_and_redirects()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);
        $course = Course::factory()->create();

        $response = $this->actingAs($admin)->post(route('video.store'), [
            'title' => 'Test Video',
            'description' => 'Test video description.',
            'course_id' => $course->id,
            'url' => 'http://example.com/video.mp4',
        ]);

        $response->assertRedirect(route('videos'));

        $this->assertDatabaseHas('videos', [
            'title' => 'Test Video',
            'description' => 'Test video description.',
            'course_id' => $course->id,
            'url' => 'http://example.com/video.mp4',
        ]);
    }

    public function test_store_validation_errors()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $response = $this->actingAs($admin)->post(route('video.store'), [
            'description' => 'Test video description.',
            'course_id' => 1,
            'url' => 'http://example.com/video.mp4',
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_like_creates_like_for_video()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);
        $video = Video::factory()->create();

        $response = $this->actingAs($user)->get(route('video.like', $video->id));

        $this->assertTrue($video->likes()->where('user_id', $user->id)->exists());
    }

    public function test_like_toggles_like()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);
        $video = Video::factory()->create();

        $response = $this->actingAs($user)->get(route('video.like', $video->id));
        $this->assertTrue($video->likes()->where('user_id', $user->id)->first()->pivot->like ? true : false);

        $this->actingAs($user)->get(route('video.like', $video->id));
        $this->assertFalse($video->likes()->where('user_id', $user->id)->first()->pivot->like ? true : false);
    }

}
