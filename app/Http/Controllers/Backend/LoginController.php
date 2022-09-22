<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('backend.login');
    }
    public function doLogin(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Hãy nhập :attribute.',
                'email.email' => 'Hãy nhập đúng dạng email',
                'password.required',
            ],
            [
                'email' => 'Email',
                'password' => 'Mật khẩu',
            ]
        );

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/admin');
        } else {
            return redirect()->back()->withErrors([
                'errorMsg' => 'Đăng nhập thất bại'
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
