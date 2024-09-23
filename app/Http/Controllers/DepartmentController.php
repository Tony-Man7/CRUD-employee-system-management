<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    // List all departments
    public function index()
    {
        $departments = Department::all();

        return Inertia::render('Departments', [
            'departments' => $departments,
        ]);
    }

    // Show a specific department
    public function show($id)
    {
        $department = Department::findOrFail($id);

        return Inertia::render('DepartmentShow', [
            'department' => $department,
        ]);
    }

    // Create a new department (show form)
    public function create()
    {
        return Inertia::render('DepartmentForm');
    }

    // Store a new department
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Department::create($validatedData);

        return redirect()->route('departments');
    }

    // Show the edit form for a department
    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return Inertia::render('DepartmentForm', [
            'department' => $department,
        ]);
    }

    // Update an existing department
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $department->update($validatedData);

        return redirect()->route('departments');
    }

    // Delete a department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments');
    }
}
