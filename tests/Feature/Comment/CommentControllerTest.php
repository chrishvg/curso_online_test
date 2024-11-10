<?php

namespace Tests\Feature\Comment;

use App\Models\User;
use App\Models\Comment;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /*public function test_index_for_admin_returns_all_comments()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $comments = Comment::factory()->count(3)->create();
        $response = $this->actingAs($admin)->get(route('comments'));

        $response->assertViewIs('comment.index');
        $response->assertViewHas('comments', $comments);
    }

    public function test_index_for_regular_user_returns_approved_comments()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);

        $approvedComment = Comment::factory()->create(['user_id' => $user->id, 'approved' => true]);
        $unapprovedComment = Comment::factory()->create(['user_id' => $user->id, 'approved' => false]);
        $response = $this->actingAs($user)->get(route('comments'));

        $response->assertViewIs('comment.indexuser');
        $response->assertViewHas('comments', [$approvedComment]);

        $this->assertTrue($response->viewData('comments')->contains($approvedComment));
        $this->assertFalse($response->viewData('comments')->contains($unapprovedComment));
    }*/
}
