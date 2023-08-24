<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\CollegeSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\NotionlitieSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CollegeSeeder::class,
            ClassroomSeeder::class,
            SectionSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
           
        ]);
    }
}
