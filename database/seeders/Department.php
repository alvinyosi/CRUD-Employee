<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Department extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = [
            ['id' => 1, 'name' => 'Accounting'],
            ['id' => 2, 'name' => 'Business Development'],
            ['id' => 3, 'name' => 'Engineering'],
            ['id' => 4, 'name' => 'Human Resources'],
            ['id' => 5, 'name' => 'Legal'],
            ['id' => 6, 'name' => 'Marketing'],
            ['id' => 7, 'name' => 'Product Management'],
            ['id' => 8, 'name' => 'Sales'],
            ['id' => 9, 'name' => 'Training'],
        ];
        
        DB::table('department')->insert($department);
    }
}
