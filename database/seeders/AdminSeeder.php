<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
             'email' => 'admin@admin.com',
             'password' => bcrypt('password'),
             'email_verified_at' => now(),
             'remember_token' => Str::random(10),
             'created_at' => now(),
             'updated_at' => now()
        ]);

        $adminRole = DB::table('roles')->where('name', 'Admin')->first();
        $user->roles()->attach($adminRole->id);
    }
}
