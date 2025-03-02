<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\UserRequest;
use App\Services\Frontend\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login() {
        return view('frontend.user.login');
    }
    
    public function signin(LoginRequest $request) {
        $signedIn = $this->userService->signin($request);

        if ($signedIn) {
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The credentials are invalid.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        $this->userService->signout($request);

        return redirect()->route('home');
    }

    public function register() {
        return view('frontend.user.register');
    }
    
    public function save(UserRequest $request) {
        $user = $this->userService->register($request);

        if ($user) {
            return redirect()->route('user.login');
        } else {
            return back();
        }
    }
}
