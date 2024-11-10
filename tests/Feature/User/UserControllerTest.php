<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_for_admin_returns_all_users()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $users = User::factory()->count(3)->create();

        $response = $this->actingAs($admin)->get(route('users'));

        $response->assertViewIs('user.index');
        $response->assertViewHas('users', User::all());
    }

    public function test_index_for_non_admin_returns_user_profile_only()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);
        $users = User::Where('id', $user->id)->get();

        $response = $this->actingAs($user)->get(route('users'));

        $response->assertViewIs('user.index');
        $response->assertViewHas('users', $users);
    }

    public function test_edit_for_admin_returns_user_to_edit()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $userToEdit = User::factory()->create();

        $response = $this->actingAs($admin)->get(route('user.edit', $userToEdit->id));

        $response->assertViewIs('user.index');
        $response->assertViewHas('userToEdit', $userToEdit);
    }

    public function test_edit_for_non_admin_returns_user_to_edit()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);

        $response = $this->actingAs($user)->get(route('user.edit', $user->id));

        $response->assertViewIs('user.index');
        $response->assertViewHas('userToEdit', $user);
    }

    public function test_store_creates_user_and_redirects()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $userData = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
        ];

        $response = $this->actingAs($admin)->post(route('user.store'), $userData);
        $response->assertRedirect(route('users'));
        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
        ]);
    }

    public function test_store_validation_errors()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $response = $this->actingAs($admin)->post(route('user.store'), [
            'name' => 'New User',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_update_for_admin_updates_user_and_redirects()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $userToEdit = User::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
            'password' => 'newpassword123',
        ];

        $response = $this->actingAs($admin)->put(route('user.update', $userToEdit->id), $updatedData);

        $response->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ]);
    }

    public function test_update_for_non_admin_updates_own_profile_and_redirects()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'User']);
        $user->roles()->attach($role);

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ];

        $response = $this->actingAs($user)->put(route('user.update', $user->id), $updatedData);

        $response->assertRedirect(route('users'));

        $this->assertDatabaseHas('users', [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ]);
    }

    public function test_update_validation_errors()
    {
        $admin = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $admin->roles()->attach($role);

        $userToEdit = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('user.update', $userToEdit->id), [
            'name' => 'Updated Name',
            'password' => 'newpassword123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

}
