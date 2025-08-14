<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = UserModel::where('email', $request->email)->first();

        // Check if the user exists, password is correct, and account is active (status == 1)
        if ($user && Hash::check($request->password, $user->password) && $user->status == 1) {
            // Store user in session
            session(['user_id' => $user->id, 'user_name' => $user->f_name,'user_status'=>$user->status, 'user_phone'=>$user->phone, 'user_email'=>$user->email]);

            // Redirect to admin dashboard
            return redirect()->route('admin');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records or your account is inactive.',
            ]);
        }
    }

    public function logout()
    {
        // Clear session and logout
        session()->flush();
        return redirect()->route('admin.login.form');
    }
}
