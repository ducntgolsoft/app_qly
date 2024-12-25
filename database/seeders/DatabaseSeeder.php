<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_check = User::where('username', 'admin')->first();
        if (!$user_check) {
            User::create([
                'username' => 'admin',
                'password' => Hash::make('Admin@123'),
                'role' => User::ROLE_MANAGER,
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'username' => 'student' . $i,
                'password' => Hash::make('Student@123'),
                'role' => User::ROLE_STUDENT,
            ]);

            Student::create([
                'user_id' => $user->id,
                'full_name' => "Student {$i}",
                'dob' => now()->subYears(20),
                'phone' => rand(1000000000, 9999999999),
                'class' => 'CNTT'.($i + 1) . Str::upper(Str::random(3)),
                'email' => "student{$i}@mail.com",
            ]);
        }

        $subjects = [
            [
                'course_code' => 'MTH',
                'course_name' => 'Math',
            ],
            [
                'course_code' => 'PHY',
                'course_name' => 'Physics',
            ],
            [
                'course_code' => 'CHM',
                'course_name' => 'Chemistry',
            ],
            [
                'course_code' => 'BIO',
                'course_name' => 'Biology',
            ],
            [
                'course_code' => 'HIS',
                'course_name' => 'History',
            ],
            [
                'course_code' => 'GEO',
                'course_name' => 'Geography',
            ],
            [
                'course_code' => 'LIT',
                'course_name' => 'Literature',
            ],
            [
                'course_code' => 'ENG',
                'course_name' => 'English',
            ],
            [
                'course_code' => 'CSC',
                'course_name' => 'Computer Science',
            ],
            [
                'course_code' => 'PED',
                'course_name' => 'Physical Education',
            ],
        ];

        foreach ($subjects as $key => $subject) {
            Course::create([
                'course_code' => $subject['course_code'],
                'course_name' => $subject['course_name'],
                'credit' => $key * 10000,
            ]);
        }
    }
}
