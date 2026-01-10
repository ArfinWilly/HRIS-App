<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('employee')->get();
        return view('tasks.index' , compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('tasks.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assignedTo' => 'required',
            // 'assignedTo' => 'required|integer|exists:employees,id',
            'dueDate' => 'required|date',
            'status' => 'required|string|max:50',
        ] , [
            'title.required' => 'Title wajib diisi.',
            'description.string' => 'Description harus berupa teks.',
            'assignedTo.required' => 'Wajib pilih karyawan.',
            'dueDate.required' => 'Tanggal wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]) ;

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('employee')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assignedTo' => 'required',
            'dueDate' => 'required|date',
            'status' => 'required|string|max:50',
        ] , [
            'title.required' => 'Title wajib diisi.',
            'description.string' => 'Description harus berupa teks.',
            'assignedTo.required' => 'Wajib pilih karyawan.',
            'dueDate.required' => 'Tanggal wajib diisi.',
            'status.required' => 'Status wajib dipilih.',

        ]) ;

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function completed(Int $id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'completed']);

        return Redirect::back()->with('success', 'Task marked as completed.');
    }

    public function pending(Int $id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => 'pending']);

        return Redirect::back()->with('success', 'Task marked as pending.');
    }
}
