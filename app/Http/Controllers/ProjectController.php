<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Auth;
use App\Services\ProjectService;

class ProjectController extends Controller
{   
    protected $ProjectService; 

    // Dependency Injection of UserService
    public function __construct(ProjectService $ProjectService)
    {
        $this->ProjectService = $ProjectService; 
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = Auth::user()->projects()->get();
        return response()->json($projects);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $project=$this->ProjectService->createProject($request->all());


        return response()->json($project, 201);
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Project $project)
    {
        return response()->json($project, 201);
    }


    /**
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $Project=$this->ProjectService->updateProject($project,$request->all());

        return response()->json($project, 201);
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        $Project=$this->ProjectService->deleteProject($project);

        return response()->json(null, 204);
    }
}