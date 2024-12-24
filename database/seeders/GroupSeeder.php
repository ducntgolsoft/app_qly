<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //viết 10 row vào bảng groups có trường id, name
        Group::insert([
            [
                'name' => 'Group 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Group 10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
