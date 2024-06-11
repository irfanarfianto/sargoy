<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles if they do not exist
        $visitorRole = Role::firstOrCreate(['name' => 'visitor']);

        // Create 50 users and assign the visitor role
        User::factory(50)->create()->each(function ($user) use ($visitorRole) {
            $user->assignRole($visitorRole);
        });
    }
}
