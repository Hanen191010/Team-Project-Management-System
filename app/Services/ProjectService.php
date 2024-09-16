<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectService
{

    /*
     * Creates a new project and assigns the current user as the project manager.
     *
     * @param array $data The project data to create.
     * @return Project The newly created project.
     */
    public function createProject(array $data)
    {
        // Create the project using the provided data
        $project = Project::create($data);

        // Attach the current user as a manager to the project
        $project->users()->attach(Auth::id(), ['role' => 'manager']);

        // Return the created project
        return $project;
    }

    /*
     * Updates an existing project with new data.
     *
     * @param Project $project The project to update.
     * @param array $data The new project data.
     * @return Project The updated project.
     */
    public function updateProject(Project $project, array $data)
    {
        // Update the project with the provided data
        $project->update($data);

        // Return the updated project
        return $project;
    }

    /*
     * Deletes a project from the database.
     *
     * @param Project $project The project to delete.
     * @return void
     */
    public function deleteProject(Project $project)
    {
        // Delete the project from the database
        $project->delete();
    }
}
