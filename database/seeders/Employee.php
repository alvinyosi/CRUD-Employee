<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Employee extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = [
            ['firstname' => 'Marcel', 'lastname' => 'Sturm', 'gender' => 'male', 'address' => 'Room 198', 'dob' => '2000-02-19', 'dept_id' => 4, 'status' => 'emp'],
            ['firstname' => 'Conney', 'lastname' => 'Matysik', 'gender' => 'male', 'address' => 'PO Box 75969', 'dob' => '1992-08-02', 'dept_id' => 8, 'status' => 'cont'],
            ['firstname' => 'Kelci', 'lastname' => 'Martinson', 'gender' => 'female', 'address' => 'Suite 32', 'dob' => '1993-05-02', 'dept_id' => 5, 'status' => 'cont'],
            ['firstname' => 'Rodina', 'lastname' => 'Stanistreet', 'gender' => 'female', 'address' => 'PO Box 98249', 'dob' => '1990-04-06', 'dept_id' => 5, 'status' => 'not_act'],
            ['firstname' => 'Aloisia', 'lastname' => 'Kedie', 'gender' => 'female', 'address' => 'PO Box 25525', 'dob' => '1993-05-14', 'dept_id' => 4, 'status' => 'cont'],
            ['firstname' => 'Thomasa', 'lastname' => 'Lutz', 'gender' => 'female', 'address' => 'Room 1423', 'dob' => '1993-09-14', 'dept_id' => 2, 'status' => 'emp'],
            ['firstname' => 'Carlen', 'lastname' => 'Pinfold', 'gender' => 'female', 'address' => 'Room 1988', 'dob' => '1993-02-22', 'dept_id' => 2, 'status' => 'emp'],
            ['firstname' => 'Andonis', 'lastname' => 'Colene', 'gender' => 'male', 'address' => '1st Floor', 'dob' => '1993-11-25', 'dept_id' => 7, 'status' => 'cont'],
            ['firstname' => 'Tonie', 'lastname' => 'Hurling', 'gender' => 'female', 'address' => '1st Floor', 'dob' => '1995-11-25', 'dept_id' => 7, 'status' => 'cont'],
            ['firstname' => 'Ashia', 'lastname' => 'Danser', 'gender' => 'female', 'address' => 'Suite 74', 'dob' => '1993-05-31', 'dept_id' => 3, 'status' => 'cont'],
            ['firstname' => 'Torrey', 'lastname' => 'Saltern', 'gender' => 'male', 'address' => '9th Floor', 'dob' => '1993-09-01', 'dept_id' => 9, 'status' => 'emp'],
            ['firstname' => 'Aggi', 'lastname' => 'O’Meara', 'gender' => 'male', 'address' => 'PO Box 629154', 'dob' => '1993-10-12', 'dept_id' => 8, 'status' => 'cont'],
            ['firstname' => 'Leupold', 'lastname' => 'Somerton', 'gender' => 'male', 'address' => 'PO Box 29254', 'dob' => '1993-06-08', 'dept_id' => 6, 'status' => 'cont'],
            ['firstname' => 'Donall', 'lastname' => 'Pavel', 'gender' => 'male', 'address' => 'Apt 1864', 'dob' => '1993-06-20', 'dept_id' => 8, 'status' => 'cont'],
            ['firstname' => 'Britt', 'lastname' => 'Ault', 'gender' => 'male', 'address' => 'Room 609', 'dob' => '1993-08-15', 'dept_id' => 8, 'status' => 'cont']
        ];

        DB::table('employee')->insert($employee);
    }
}
