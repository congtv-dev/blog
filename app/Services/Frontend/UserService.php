<?php

namespace App\Services\Frontend;

use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserService {
    public function signin(LoginRequest $request) {
        $credentials = $request->safe()->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return true;
        }
 
        return false;
    }
    
    public function signout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return true;
    }
    
    public function register(UserRequest $request) {
        $user = $request->safe()->only(['fullname', 'email', 'password']);

        return User::create([
            'fullname' => $user['fullname'],
            'email' => $user['email'],
            'password' => Hash::make($user['password'])
        ]);
    }
}