<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with(['category', 'tags'])->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('tasks.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
           $task = Task::create($request->validated());

        if ($request->filled('tags')) {
            $task->tags()->sync($request->tags);
        }

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if ($task->trashed()) {
            return redirect()->route('tasks.index')
                             ->with('error', 'Task not found.');
        }
        $task->load(['category', 'tags']);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->trashed()) {
            return redirect()->route('tasks.index')
                             ->with('error', 'Cannot edit a deleted task.');
        }
        $categories = Category::all();
        $tags = Tag::all();

        $task->load('tags');

        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {

        if ($task->trashed()) {
        return redirect()->route('tasks.index')
                ->with('error', 'Cannot update a deleted task.');
        }
        $task->update($request->validated());

        $task->tags()->sync($request->tags ?? []);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->trashed()) {
        return redirect()->route('tasks.index')
            ->with('error', 'This task is already deleted.');
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
