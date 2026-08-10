<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->integer('per_page', 10);

        $tasks = Task::with(['category', 'tags'])
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $tasks->items(),
            'pagination' => [
                'current_page' => $tasks->currentPage(),
                'last_page' => $tasks->lastPage(),
                'per_page' => $tasks->perPage(),
                'total' => $tasks->total(),
                'from' => $tasks->firstItem(),
                'to' => $tasks->lastItem(),
                'next_page_url' => $tasks->nextPageUrl(),
                'prev_page_url' => $tasks->previousPageUrl(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        if ($request->filled('tags')) {
            $task->tags()->sync($request->tags);
        }

        $task->load(['category', 'tags']);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'data' => $task,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        if ($task->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.',
            ], 404);
        }

        $task->load(['category', 'tags']);

        return response()->json([
            'success' => true,
            'data' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateTaskRequest $request,
        Task $task
    ): JsonResponse {
        if ($task->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update a deleted task.',
            ], 404);
        }

        $task->update($request->validated());

        $task->tags()->sync($request->tags ?? []);

        $task->load(['category', 'tags']);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'data' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        if ($task->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'This task is already deleted.',
            ], 404);
        }

        $deletedTask = [
            'id' => $task->id,
            'title' => $task->title,
        ];

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.',
            'data' => $deletedTask,
        ]);
    }

    /**
     * Toggle the completion status of the task.
     */
    public function toggleCompleted(Task $task): JsonResponse
    {
        if ($task->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update a deleted task.',
            ], 404);
        }

        $task->update([
            'completed' => !$task->completed,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task completion status updated successfully.',
            'data' => [
                'id' => $task->id,
                'completed' => $task->completed,
            ],
        ]);
    }
}
