<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\Referee;
use App\Models\Service;
use App\Models\TourAndReferee;
use App\Models\TournamentRefereeAccount;
use App\Models\User;
use App\Modules\Auth\Requests\ChangePasswordRequest;
use App\Modules\Auth\Requests\ForgotPasswordRequest;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Requests\RegisterRequest;
use App\Modules\Auth\Requests\ResetPasswordRequest;
use App\Notifications\ResetPasswordNotification;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    private User $user;
    private PasswordReset $passwordReset;
    private int $time;

    public function __construct()
    {
        $this->user = new User();
        $this->passwordReset = new PasswordReset();
        $this->time = 1;
    }

    public function login()
    {
        return view('Auth::Login');
    }
    public function loginSubmit(LoginRequest $loginRequest)
    {
        $user_info = $loginRequest->userInfo;
        if (Auth::attemptWhen(['phone' => $user_info, 'password' => $loginRequest->password], function (User $user) {
            return $user->deleted_at === null;
        }, $loginRequest->rememberMe)) {
            return redirect()->route('home.index');
        }
        if (Auth::attemptWhen(['email' => $user_info, 'password' => $loginRequest->password], function (User $user) {
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

    public function register()
    {
        return view('Auth::Register');
    }
    
    public function registerSubmit(RegisterRequest $registerRequest)
    {
        try {
            $data = $registerRequest->all();
            $data['password'] = Hash::make($data['password']);
            $data['role'] = User::ROLE_STUDENT;
            $data['status'] = 'active';
            $user = $this->user->create($data);
            if ($user) {
                Auth::login($user);
                return redirect()->route('home.index');
            }
            return redirect()->route('login')->with('success', 'Đăng ký thành công !');
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('fail', 'Đã có lỗi xảy ra !');
        }
    }

    public function forgotPW()
    {
        return view('Auth::ForgotPassword');
    }

    public function forgotPWSubmit(ForgotPasswordRequest $forgotPWRequest)
    {
        try {
            $email = $forgotPWRequest->userInfo;
            $this->passwordReset->where('email', $email)->delete();
            $passwordReset = $this->passwordReset->create([
                'email' => $email,
                'token' => Str::random(50),
                'created_at' => Carbon::now()
            ]);
            if ($passwordReset) {
                $user = $this->user->where('email', $email)->first();
                if (!$user) {
                    return back()->with('fail', 'Tài khoản không tồn tại !');
                }
                $user->notify(new ResetPasswordNotification($passwordReset->token, $this->time));
            }
            return redirect()->route('login')->with('success', 'Chúng tôi đã gửi mã xác nhận đến email của bạn !');
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('fail', 'Đã có lỗi xảy ra !');
        }
    }

    public function resetPW($token)
    {
        $passwordReset = $this->passwordReset->where('token', $token)->first();
        if ($passwordReset) {
            if (Carbon::parse($passwordReset->created_at)->addMinutes($this->time)->isPast()) {
                $passwordReset->delete();
                return redirect()->route('login')->with('fail', 'Hết thời gian đặt lại mật khẩu !');
            }
            $email = $passwordReset->email;
            return view('Auth::ResetPassword', compact('token', 'email'));
        } else {
            return redirect()->route('login')->with('fail', 'Mã xác nhận không đúng !');
        }
    }

    public function resetPWSubmit(ResetPasswordRequest $resetPWRequest, $token,)
    {
        try {
            $passwordReset = $this->passwordReset->where('token', $token)->first();
            if (Carbon::parse($passwordReset->created_at)->addMinutes($this->time)->isPast()) {
                $passwordReset->delete();
                return redirect()->route('login')->with('fail', 'Hết thời gian đặt lại mật khẩu');
            }
            $user = $this->user->where('email', $passwordReset->email)->first();
            if (!$user) {
                return redirect()->route('login')->with('fail', 'Tài khoản không tồn tại !');
            }
            $user->update([
                'password' => Hash::make($resetPWRequest->newPassword),
            ]);
            $passwordReset->delete();
            return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công !');
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('fail', 'Đã có lỗi xảy ra !');
        }
    }
}