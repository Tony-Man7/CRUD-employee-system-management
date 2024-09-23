<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRecord extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'department_id', 'start_date', 'role'];

    // A service record belongs to an employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // A service record belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}