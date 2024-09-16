<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Project; 
use Illuminate\Http\Request; 


class ProjectService
{
    
    public function createProject(array $data)
    {   $project=Project::create($data);
        $project->users()->attach(Auth::id(), ['role' => 'manager']); // تعيين المستخدم الحالي كمدير
       return $project;
    }

   
    public function updateProject(Project $Project, array $data)
    {
        $Project->update($data); 
        return $Project; 
    }

  
    public function deleteProject(Project $Project)
    {
        $Project->delete(); 
    }
}