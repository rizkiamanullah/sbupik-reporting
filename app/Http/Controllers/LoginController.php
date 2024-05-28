<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use DB;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = DB::table('users')->where('email',$request->email)->first();
            if ($user->user_role_id > 90){
                // admin
                return redirect()->intended('dashboard');
            } else {
                // officer
                if ($user->user_role_id == 1 ){
                    return redirect()->intended('dashboard');
                // pm/ higher
                } elseif ($user->user_role_id == 2){
                    return redirect()->intended('dashboard');
                }
            }
        }

        return back()->with(['msg' => 'Email/ Password tidak ditemukan']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
