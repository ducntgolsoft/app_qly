<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    protected $duplicateUsername = 0;
    protected $duplicateEmail = 0;

    public function model(array $row)
    {
        try {
            $username = $row['username'];
            $full_name = $row['full_name'];
            $class = $row['class'];
            $dob = $row['dob'];
            $email = $row['email'];
            $phone = $row['phone'];

            // Check for existing username or email
            $user = User::where('username', $username)->first();
            if ($user) {
                $this->duplicateUsername++;
                return null;
            }

            $user = User::where('email', $email)->first();
            if ($user) {
                $this->duplicateEmail++;
                return null;
            }

            $user = User::create([
                'username' => $username,
                'password' => Hash::make('123@123'),
            ]);

            $user->student()->create([
                'full_name' => $full_name,
                'class' => $class,
                'dob' => $dob,
                'email' => $email,
                'phone' => $phone,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error importing student: ' . $e->getMessage() . ' Row: ' . json_encode($row));
            return null;
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function getDuplicateUsername()
    {
        return $this->duplicateUsername;
    }

    public function getDuplicateEmail()
    {
        return $this->duplicateEmail;
    }
}
