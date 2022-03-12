<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Http\Requests\Backend\ResetPasswordAdmin;
use App\Mail\ResetPasswordAdmin as MailResetPasswordAdmin;
use App\Models\Backend\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginAdminController extends Controller
{

    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('backend.auth.sign-in');
        }
    }

    public function login(LoginRequest $request)
    {
        $remember = $request->remember ? true : false;

        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Login failed !!!');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->logout()) {
            return redirect()->route('admin.show_login_form');
        } else {
            return redirect()->back();
        }
    }

    // Show form enter email
    public function showFormEnterMail()
    {
        return view('backend.auth.enter-email');
    }

    // Send mail to reset password
    public function sendMailReset(Request $request)
    {
        $email = $request->email;

        $admin = Admin::where('email', $email)->first();

        if ($admin) {
            $token = Str::random(20);

            $admin->token = $token;

            $admin->save();

            // Send mail.
            Mail::to($request->email)->send(new MailResetPasswordAdmin($email, $token, $admin->id));

            return redirect()->back()->with('success', "Check your email $email to reset password !");
        }

        return redirect()->back()->with('error', "Email $email doesn't exits !");
    }

    // Confirm token
    public function confirmToken(Request $request)
    {

        $token = $request->token;

        $admin = Admin::where('token', $token)->first();


        if ($admin) {
            $admin->token = '';

            $id = $admin->id;

            $admin->save();

            // Redirect route success.
            return redirect()->route('admin.reset_password', ['id' => $id]);
        } else {
            return redirect()->route('admin.forgot_password')->with('error', 'Check token failed please try again !');
        }
    }

    public function showFormReset(Request $request)
    {
        $id = $request->id;

        return view('backend.auth.reset-password', compact('id'));
    }

    // Send mail to reset password
    public function handleReset(ResetPasswordAdmin $request)
    {

        $id = $request->id;

        $admin = Admin::where('id', $id);

        $new_pw = Hash::make($request->password);

        $admin->update(['password' => $new_pw]);

        return redirect()->route('admin.show_login_form');
    }
}
