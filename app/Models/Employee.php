<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'department_id'];

    // An employee has many service records
    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }

    // An employee belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
