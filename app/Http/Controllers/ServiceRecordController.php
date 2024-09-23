<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ServiceRecord;
use App\Models\Employee;
use App\Models\Department;


class ServiceRecordController extends Controller
{
      // List all service records
      public function index()
      {
          // Retrieve all service records with related employee and department data
          $serviceRecords = ServiceRecord::with(['employee', 'department'])->get();
  
          // Retrieve all employees and departments
          $employees = Employee::all();
          $departments = Department::all();
  
          return Inertia::render('ServiceRecords', [
              'serviceRecords' => $serviceRecords,
              'employees' => $employees,
              'departments' => $departments,
          ]);
      }

    // // Show a specific service record
    // public function show($id)
    // {
    //     $serviceRecord = ServiceRecord::with(['employee', 'department'])->findOrFail($id);

    //     return Inertia::render('ServiceRecordShow', [
    //         'serviceRecord' => $serviceRecord,
    //     ]);
    // }

    // Create a new service record (show form)
    public function create()
    {
        $employees = Employee::all();
        $departments = Department::all();

        return Inertia::render('ServiceRecordForm', [
            'employees' => $employees,
            'departments' => $departments,
        ]);
    }

    // Store a new service record
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'required|date',
            'role' => 'required|string|max:255',
        ]);

        ServiceRecord::create($validatedData);

        return redirect()->route('service-records');
    }

    // Show the edit form for a service record
    public function edit($id)
    {
        $serviceRecord = ServiceRecord::with(['employee', 'department'])->findOrFail($id);
        $employees = Employee::all();
        $departments = Department::all();

        return Inertia::render('ServiceRecordForm', [
            'serviceRecord' => $serviceRecord,
            'employees' => $employees,
            'departments' => $departments,
        ]);
    }

    // Update an existing service record
    public function update(Request $request, $id)
    {
        $serviceRecord = ServiceRecord::findOrFail($id);

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'required|date',
            'role' => 'required|string|max:255',
        ]);

        $serviceRecord->update($validatedData);

        return redirect()->route('service-records');
    }

    // Delete a service record
    public function destroy($id)
    {
        $serviceRecord = ServiceRecord::findOrFail($id);
        $serviceRecord->delete();

        return redirect()->route('service-records');
    }
}
