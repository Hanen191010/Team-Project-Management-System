<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /*
     * Create a new user.
     *
     * @param array $data The data for the new user.
     * @return User The newly created user object.
     */
    public function createUser(array $data)
    {
        // Create the user using the provided data, hashing the password
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Use Hash::make() for password hashing
        ]);

        // Attach the user to the project with their role
        $user->projects()->attach($data['project_id'], ['role' => $data['role']]);

        // Return the newly created user object
        return $user;
    }

    /*
     * Update an existing user.
     *
     * @param User $user The user object to update.
     * @param array $data The data to update the user with.
     * @return User The updated user object.
     */
    public function updateUser(User $user, array $data)
    {
        // Update the user with the provided data
        $user->update($data);

        // Return the updated user object
        return $user;
    }

    /*
     * Delete a user.
     *
     * @param User $user The user object to delete.
     * @return void
     */
    public function deleteUser(User $user)
    {
        // Delete the user from the database
        $user->delete();
    }
}
