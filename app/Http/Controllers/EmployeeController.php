<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller {
    public function index() {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        return view('employees.create'); 
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'employee_fname' => 'required|string|max:100',
            'employee_lname' => 'required|string|max:100',
        ]);
    
        // ✅ Actually insert data into the database
        Employee::create([
            'employee_fname' => $validated['employee_fname'],
            'employee_lname' => $validated['employee_lname'],
        ]);
    
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    

    public function show($id) {
        return Employee::findOrFail($id); // Find employee by ID
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'employee_fname' => 'required|string|max:100',
            'employee_lname' => 'required|string|max:100',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}

