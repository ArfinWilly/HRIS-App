<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')->get(); // Fetch payroll data from the database
        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all(); // Fetch employees for selection in the form
        return view('payrolls.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'employeeId' => 'required|exists:employees,id',
            'salary' => 'required|numeric',
            'bonuses' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'paymentDate' => 'required|date',
        ]);

        $netSalary = $validatedData['salary'] + ($validatedData['bonuses'] ?? 0) - ($validatedData['deductions'] ?? 0);
        $payroll = ($validatedData + ['netSalary' => $netSalary]);
        Payroll::create($payroll);

        return redirect()->route('payrolls.index')->with('success', 'Payroll record created successfully.');
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
        $employees = Employee::all();
        $payroll = Payroll::findOrFail($id);
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Payroll::findOrFail($id);

        $validatedData = $request->validate([
            'employeeId' => 'required|exists:employees,id',
            'salary' => 'required|numeric',
            'bonuses' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'paymentDate' => 'required|date',
        ]);

        $netSalary = $validatedData['salary'] + ($validatedData['bonuses'] ?? 0) - ($validatedData['deductions'] ?? 0);
        $payroll = ($validatedData + ['netSalary' => $netSalary]);
        $id->update($payroll);

        return redirect()->route('payrolls.index')->with('success', 'Payroll record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll record deleted successfully.');
    }
}
