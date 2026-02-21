<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // CRITICAL: This was missing!
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ]
        );

        // Create Student
        User::updateOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'John Student',
                'password' => Hash::make('student'),
                'role' => 'student',
            ]
        );

        // Create Courses
        Course::updateOrCreate(
            ['course_code' => 'CS101'],
            [
                'course_name' => 'Computer Science 1',
                'description' => 'Basics of computing and logic.',
                'capacity' => 30
            ]
        );

        Course::updateOrCreate(
            ['course_code' => 'MATH202'],
            [
                'course_name' => 'Advanced Calculus',
                'description' => 'Limits, derivatives, and integrals.',
                'capacity' => 25
            ]
        );
    }
}