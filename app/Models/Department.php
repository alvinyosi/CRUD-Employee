<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department'; // Specify the correct table name

    public function employees()
    {
        return $this->hasMany(Employee::class, 'dept_id');
    }
}
