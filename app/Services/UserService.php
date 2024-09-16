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
     * @return \Illuminate\Http\JsonResponse The response with user details and token.
     */
    public function createUser(array $data)
    {
        $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']), // تشفير كلمة المرور
        ]);
    $user->projects()->attach($user['id'], ['role' => $data['role']],['project_id' => $data['project_id']]);
    // إرجاع المستخدم الجديد كاستجابة JSON مع رمز 201 (تم إنشاء المورد بنجاح)
    return $user;
    
    }

    /*
     * Update an existing user.
     *
     * @param User $User The user object to update.
     * @param array $data The data to update the user with.
     * @return User The updated user object.
     */
    public function updateUser(User $User, array $data)
    {
        $User->update($data); 
        return $User; 
    }

    /*
     * Delete a user.
     *
     * @param User $User The user object to delete.
     * @return void
     */
    public function deleteUser(User $User)
    {
        $User->delete(); 
    }
}
