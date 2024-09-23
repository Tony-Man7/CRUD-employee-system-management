<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
        $departments = Department::all(); 

        return Inertia::render('Employees', [
            'employees' => $employees,
            'departments' => $departments
        ]);
    }

    // Show a specific employee with its department and render the Employee details page
    public function show($id)
    {
        $employee = Employee::with('department')->findOrFail($id);
        return Inertia::render('EmployeeShow', [
            'employee' => $employee,
        ]);
    }

    public function create()
    {
        $departments = Department::all();

        return Inertia::render('EmployeeForm', [
            'departments' => $departments,
        ]);
    }


    // Create a new employee
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'nullable|string|max:15',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee = Employee::create($validatedData);
        return Inertia::location(route('employees'));

    }

   // Show the edit form for an employee
    public function edit($id)
    {
        $employee = Employee::with('department')->findOrFail($id);
        $departments = Department::all();

        return Inertia::render('EditEmployee', [
            'employee' => $employee,
            'departments' => $departments,
        ]);
    }

    // Update an existing employee
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:15',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee->update($validatedData);
        return Inertia::location(route('employees'));
    }


    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return Inertia::location(route('employees'));

    }
}
