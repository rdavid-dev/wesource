<?php
namespace App\Services;

use App\Models\User;

class UserService {

    /**
     * Create user details
     * 
     * @param $request Request
     */
    public function createUser($request)
    {
        $user = User::UpdateOrCreate([
            'id' => $request['id'] ?? 0
        ],$request);
        $this->createUserProfile($user, $request);
    }

    /**
     * Create User Profile Details
     * 
     * @param $user \App\Models\User
     * @param $request Request
     * 
     */
    public function createUserProfile($user, $request)
    {
        $user->profile()->UpdateOrCreate([
            'user_id' => $user->id
        ],$request);
    }
}