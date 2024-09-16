<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $UserService;

    // Dependency Injection of UserService
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all users from the database and return them as a JSON response
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string', // Name is required and must be a string
            'email' => 'required|string|email|unique:users', // Email is required, must be a string, a valid email format, and unique
            'password' => 'required|string', // Password is required and must be a string
            'role' => 'required|in:developer,tester', // Role is required and must be either 'developer' or 'tester'
            'project_id' => 'required|exists:projects,id' // Project ID is required and must exist in the projects table
        ]);

        // Create a new user using the validated data and the UserService
        $user = $this->UserService->createUser($request->all());

        // Return the newly created user as a JSON response with a 201 Created status code
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the requested user from the database using the ID
        $user = User::findOrFail($id);

        // Return the user as a JSON response
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Retrieve the requested user from the database using the ID
        $user = User::findOrFail($user->id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'nullable|string', // Name is optional and must be a string
            'email' => 'nullable|string|email|unique:users', // Email is optional, must be a string, a valid email format, and unique
            'password' => 'nullable|string', // Password is optional and must be a string
        ]);

        // Update the existing user using the validated data and the UserService
        $updatedUser = $this->UserService->updateUser($user, $request->all());

        // Return the updated user as a JSON response with a 201 Created status code
        return response()->json($updatedUser, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Delete the user from the database using the UserService
        $user = $this->UserService->deleteUser($user);

        // Return an empty JSON response with a 204 No Content status code, indicating successful deletion
        return response()->json(null, 204);
    }
}