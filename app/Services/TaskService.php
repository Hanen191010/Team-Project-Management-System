<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskService
{

    /*
     * Creates a new task in the database.
     *
     * @param array $data The task data to create.
     * @return Task The newly created task.
     */
    public function createTask(array $data)
    {
        // Create the task using the provided data
        return Task::create($data);
    }

    /*
     * Updates an existing task with new data.
     *
     * @param Task $task The task to update.
     * @param array $data The new task data.
     * @return Task The updated task.
     */
    public function updateTask(Task $task, array $data)
    {
        // Update the task with the provided data
        $task->update($data);

        // Return the updated task
        return $task;
    }

    /*
     * Deletes a task from the database.
     *
     * @param Task $task The task to delete.
     * @return void
     */
    public function deleteTask(Task $task)
    {
        // Delete the task from the database
        $task->delete();
    }
}
