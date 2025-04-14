<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Exports\TasksExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function edit(Task $task)
    {
        return response()->json($task);
    }

    public function getData()
    {
        $tasks = Task::query();

        return DataTables::of($tasks)
            ->addColumn('status', function ($task) {
                return $task->is_completed ? 'Completed' : 'Pending';
            })
            ->addColumn('actions', function ($task) {
                return view('tasks.partials.actions', compact('task'))->render();
            })
            ->rawColumns(['actions']) // allow HTML in 'actions' column
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
            'is_completed' => $request->is_completed,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function export($format) 
    {
        $filename = 'tasks_export_' .now()->format('Ymd_His') . '.' . $format;

        return Excel::download(new TasksExport, $filename);
    }
}
