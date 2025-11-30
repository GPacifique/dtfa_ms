<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Staff;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('staff')->latest()->paginate(15);
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $staffs = Staff::all();
        return view('admin.tasks.create', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'goal' => 'required|string',
            'objective' => 'required|string',
            'activities' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reporting' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $task->load('staff');
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $staffs = Staff::all();
        return view('admin.tasks.edit', compact('task', 'staffs'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'goal' => 'required|string',
            'objective' => 'required|string',
            'activities' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reporting' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $task->update($request->all());

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
}
