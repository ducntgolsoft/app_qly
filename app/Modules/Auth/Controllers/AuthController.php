<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Auth\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth::Login');
    }

    public function loginSubmit(LoginRequest $loginRequest)
    {
        $user_info = $loginRequest->userInfo;
        if (Auth::attemptWhen(['username' => $user_info, 'password' => $loginRequest->password], function (User $user) {
            return $user->deleted_at === null;
        }, $loginRequest->rememberMe)) {
            return redirect()->route('home.index');
        }
        return back()->withInput()->with('error', 'Sai tài khoản hoặc mật khẩu !');
    }

    public function logout()
    {
        User::where('id', Auth::id())->update(['remember_token' => null]);
        session()->flush();
        Auth::logout();
        return redirect()->route('home.index');
    }
}
