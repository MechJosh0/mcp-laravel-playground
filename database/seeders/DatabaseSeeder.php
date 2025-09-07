<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $users = User::factory(10)->create();

        $users->push($testUser)->each(function (User $user) {
            Task::factory()
                ->count(rand(2, 5))
                ->create(['user_id' => $user->id]);
        });
    }
}
