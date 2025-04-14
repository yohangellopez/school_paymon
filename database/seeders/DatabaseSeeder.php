<?php

namespace Database\Seeders;

use App\Models\Academy;
use App\Models\Enrollment;
use App\Models\Representative;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Paymon Admin',
            'email' => 'admin@paymon.com',
            'password' => bcrypt('password'),
        ]);

        Academy::factory(5)
                ->hasCourses(3)
                ->create();

        Representative::factory(10)
                ->hasStudents(2)
                ->create();

        Enrollment::factory(50)->create();
    }
}
