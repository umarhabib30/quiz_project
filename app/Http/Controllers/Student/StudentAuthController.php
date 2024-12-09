<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{

    public function index(){
        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // dd(Auth::guard('student')->user());
            return redirect('welcome');
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

}
