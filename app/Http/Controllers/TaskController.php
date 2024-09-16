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

    // Dependency Injection of UserService
    public function __construct(TaskService $TaskService)
    {
        $this->TaskService = $TaskService; 
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->get();
        return response()->json($tasks);
    }

    

    /**
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:جديد,قيد العمل,منجز',
            'priority' => 'required|in:منخفض,متوسط,عالي',
            'due_date' => 'nullable|date',
            'project_id'=>'required|exists:projects,id'
        ]);

        $task = $this->TaskService->createTask($request->all());
        return response()->json($task, 201);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }


    /**
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable|in:جديد,قيد العمل,منجز',
            'priority' => 'nullable|in:منخفض,متوسط,عالي',
            'due_date' => 'nullable|date',
        ]);

        $task = $this->TaskService->updateTask($task,$request->all());

        return response()->json($task);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task = $this->TaskService->deleteTask($task);

        return response()->json(null, 204);
    }
}