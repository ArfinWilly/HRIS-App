<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::with('employee')->get();
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employeeId' => 'required|exists:employees,id',
            'leaveReason' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ], [
            'employeeId.required' => 'Wajib memilih karyawan.',
            'employeeId.exists' => 'Karyawan yang dipilih tidak valid.',
            'leaveReason.required' => 'Alasan cuti wajib diisi.',
            'startDate.required' => 'Tanggal mulai cuti wajib diisi.',
            'startDate.date' => 'Format tanggal mulai cuti tidak valid.',
            'endDate.required' => 'Tanggal akhir cuti wajib diisi.',
            'endDate.date' => 'Format tanggal akhir cuti tidak valid.',
            'endDate.after_or_equal' => 'Tanggal akhir cuti harus sama atau setelah tanggal mulai cuti.',
        ]);

        Leave::create($validatedData + ['status'=> 'pending']);

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted successfully.');
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
        $leave = Leave::findOrFail($id);
        $employees = Employee::all();
        return view('leaves.edit', compact('leave', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leave = Leave::findOrFail($id);

        $validatedData = $request->validate([
            'employeeId' => 'required|exists:employees,id',
            'leaveReason' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ], [
            'employeeId.required' => 'Wajib memilih karyawan.',
            'employeeId.exists' => 'Karyawan yang dipilih tidak valid.',
            'leaveReason.required' => 'Alasan cuti wajib diisi.',
            'startDate.required' => 'Tanggal mulai cuti wajib diisi.',
            'startDate.date' => 'Format tanggal mulai cuti tidak valid.',
            'endDate.required' => 'Tanggal akhir cuti wajib diisi.',
            'endDate.date' => 'Format tanggal akhir cuti tidak valid.',
            'endDate.after_or_equal' => 'Tanggal akhir cuti harus sama atau setelah tanggal mulai cuti.',
        ]);

        $leave->update($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave request deleted successfully.');
    }
}
