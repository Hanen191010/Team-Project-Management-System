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

    // Dependency Injection of ProjectService
    public function __construct(ProjectService $ProjectService)
    {
        $this->ProjectService = $ProjectService; 
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all projects associated with the authenticated user
        $projects = Auth::user()->projects()->get();
        // Return the projects as a JSON response
        return response()->json($projects);
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        // Use the ProjectService to create a new project based on the validated data
        $project = $this->ProjectService->createProject($request->all());

        // Return the newly created project as a JSON response with a 201 Created status code
        return response()->json($project, 201);
    }

    /*
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // Return the requested project as a JSON response with a 201 Created status code
        return response()->json($project, 201);
    }

    /*
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        // Use the ProjectService to update the existing project
        $project = $this->ProjectService->updateProject($project, $request->all());

        // Return the updated project as a JSON response with a 201 Created status code
        return response()->json($project, 201);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // Use the ProjectService to delete the project
        $project = $this->ProjectService->deleteProject($project);

        // Return an empty response with a 204 No Content status code, indicating successful deletion
        return response()->json(null, 204);
    }
}
