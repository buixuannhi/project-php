<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Http\Requests\Frontend\ChangePassword;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Mail\ResetPasswordUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginUserController extends Controller
{
    // Register form
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend.auth.register');
        }
    }

    // Register handler
    public function register(RegisterRequest $request)
    {
        if (User::addNewAccount($request)) {
            return redirect()->route('user.show_login_form');
        } else {
            return redirect()->back();
        }
    }

    // Show form Login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend.auth.sign-in');
        }
    }

    // Handle Login
    public function login(LoginRequest $request)
    {

        $remember = $request->remember ? true : false;

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'Login failed !!!');
        }
    }

    // Logout
    public function logout()
    {
        if (Auth::logout()) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }

    // Show form enter email
    public function showFormEnterMail()
    {
        return view('frontend.auth.enter-email');
    }

    // Send mail to reset password
    public function sendMailReset(Request $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if ($user) {
            $token = Str::random(20);

            $user->token = $token;

            $user->save();

            // Send mail.
            Mail::to($email)->send(new ResetPasswordUser($email, $token, $user->id));

            return redirect()->back()->with('success', "Check your email $email to reset password !");
        }

        return redirect()->back()->with('error', "Email $email doesn't exits !");
    }

    // Confirm token
    public function confirmToken(Request $request)
    {
        $token = $request->token;

        $user = User::where('token', $token)->first();

        if ($user) {
            $user->token = '';

            $id = $user->id;

            $user->save();

            $request->session()->push('user_id', $id);

            // Redirect route success.
            return redirect()->route('user.reset_password');
        } else {
            return redirect()->route('user.forgot_password')->with('error', 'Check token failed please try again !');
        }
    }

    // Show form enter new pass
    public function showFormReset()
    {
        return view('frontend.auth.reset-password');
    }

    // Handle Reset Pass
    public function handleReset(Request $request)
    {
        $id = session('user_id')[0];

        if ($id) {
            $user = User::where('id', $id);

            $new_pw = Hash::make($request->password);

            $user->update(['password' => $new_pw]);

            session()->forget('user_id');

            return redirect()->route('user.show_login_form');
        } else {
            return redirect()->route('user.forgot_password');
        }
    }

    // Change Password
    public function changePassword(ChangePassword $request)
    {
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        $old_pw = $request->old_password;

        $new_pw = $request->password;

        // Check old password
        $credentials = ['email' => $user->email, 'password' => $old_pw];

        if (Auth::attempt($credentials)) {

            $new_pw = Hash::make($request->password);

            $user->update(['password' => $new_pw]);

            return redirect()->back()->with('success', 'Update password successfully !');
        } else {
            return redirect()->back()->with('error', 'Password don not match !');
        }
    }
}
