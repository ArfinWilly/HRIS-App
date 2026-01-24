<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::with('employee')->get();
        return view('presences.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('presences.create' , compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employeeId' => 'required|exists:employees,id',
            'date' => 'required|date',
            'checkIn' => 'required',
            'checkOut' => 'nullable',
            'status' => 'required|string|max:50',
        ], [
            'employeeId.required' => 'Employee wajib diisi.',
            'date.required' => 'Date wajib diisi.',
            'checkIn.required' => 'Check-In wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);

        Presence::create($validatedData);
        return redirect()->route('presences.index')->with('success', 'Presence created successfully.');
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
        $presence = Presence::findOrFail($id);
        $employees = Employee::all();
        return view('presences.edit' , compact('presence', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'employeeId' => 'required|exists:employees,id',
            'date' => 'required|date',
            'checkIn' => 'required',
            'checkOut' => 'nullable',
            'status' => 'required|string|max:50',
        ], [
            'employeeId.required' => 'Employee wajib diisi.',
            'date.required' => 'Date wajib diisi.',
            'checkIn.required' => 'Check-In wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ]);

        $presence = Presence::findOrFail($id);
        $presence->update($validatedData);
        return redirect()->route('presences.index')->with('success', 'Presence updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $presence = Presence::findOrFail($id);
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully.');
    }
}
