<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $TaskService;

    // Dependency Injection of TaskService
    public function __construct(TaskService $TaskService)
    {
        $this->TaskService = $TaskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Authorize the user to view any tasks
        $this->authorize('viewAny', Task::class);

        // Retrieve all tasks associated with the authenticated user
        $tasks = Auth::user()->tasks()->get();

        // Return the tasks as a JSON response
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorize the user to create tasks
        $this->authorize('create', Task::class);

        // Validate the incoming request data
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:جديد,قيد العمل,منجز',
            'priority' => 'required|in:منخفض,متوسط,عالي',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id'
        ]);

        // Use the TaskService to create a new task based on the validated data
        $task = $this->TaskService->createTask($request->all());

        // Return the newly created task as a JSON response with a 201 Created status code
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // Authorize the user to view the specific task
        $this->authorize('view', $task);

        // Return the requested task as a JSON response
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable|in:جديد,قيد العمل,منجز',
            'priority' => 'nullable|in:منخفض,متوسط,عالي',
            'due_date' => 'nullable|date',
        ]);

        // Authorize the user to update the specific task
        $this->authorize('update', $task);

        // Use the TaskService to update the existing task
        $task = $this->TaskService->updateTask($task, $request->all());

        // Return the updated task as a JSON response
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        // Authorize the user to delete the specific task
        $this->authorize('delete', $task);

        // Use the TaskService to delete the task
        $task = $this->TaskService->deleteTask($task);

        // Return an empty response with a 204 No Content status code, indicating successful deletion
        return response()->json(null, 204);
    }
}
