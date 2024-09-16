<?php

namespace App\Services;

use App\Models\Task; 
use Illuminate\Http\Request; 

class TaskService
{
    
    public function createTask(array $data)
    {
       return Task::create($data);
    
    }

   
    public function updateTask(Task $Task, array $data)
    {
        $Task->update($data); 
        return $Task; 
    }

  
    public function deleteTask(Task $Task)
    {
        $Task->delete(); 
    }
}
