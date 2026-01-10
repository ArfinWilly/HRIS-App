<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['department', 'role'])->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with(['department', 'role'])->get();
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.create', compact('departments', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:employees,email',
            'phoneNumber' => 'nullable|string|max:20',
            'birthDate' => 'nullable|date',
            'hireDate' => 'required|date',
            'departmentId' => 'required|exists:departments,id',
            'roleId' => 'required|exists:roles,id',
            'status' => 'required|string|max:50',
            'salary' => 'required|numeric|min:0',
        ] , [
            'fullName.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'hireDate.required' => 'Tanggal masuk wajib diisi.',
            'hireDate.date' => 'Format tanggal masuk tidak valid.',
            'departmentId.required' => 'Wajib memilih department.',
            'departmentId.exists' => 'The selected department is invalid.',
            'roleId.required' => 'Wajib memilih role.',
            'roleId.exists' => 'The selected role is invalid.',
            'status.required' => 'Status wajib diisi.',
            'salary.required' => 'Gaji wajib diisi.',
            'salary.numeric' => 'Gaji harus berupa angka.',
            'salary.min' => 'Gaji tidak boleh kurang dari 0.',
        ]);

        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
