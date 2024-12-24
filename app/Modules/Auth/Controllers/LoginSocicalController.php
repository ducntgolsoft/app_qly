<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class LoginSocicalController extends Controller
{

    public function redirect(Request $request): RedirectResponse
    {
        return Redirect::to(Socialite::driver('google')->stateless()->redirect()->getTargetUrl());
    }

    public function callback()
    {
        $socialiteUser = Socialite::driver('google')->stateless()->user();
        $column = 'email';
        $email = $socialiteUser->getEmail();
        $user = User::where($column, $email)->first();
        return $this->extracted($user);
    }

    public function extracted($user)
    {
        if (!$user) {
            return redirect()->route('login')->with('fail', 'Tài khoản chưa được đăng ký !');
        }
        if ($user->status == 0) {
            Auth::login($user);
            return redirect()->route('home');
        } 
        else {
            return redirect()->route('login')->with('fail', 'Tài khoản bị khoá !');
        }
    }
}