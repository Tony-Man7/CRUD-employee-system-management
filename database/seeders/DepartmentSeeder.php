<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Human Resources', 'description' => 'Handles employee relations and benefits.'],
            ['name' => 'IT', 'description' => 'Manages information technology and support.'],
            ['name' => 'Finance', 'description' => 'Handles financial planning and management.'],
            ['name' => 'Marketing', 'description' => 'Focuses on market research and advertising.'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
