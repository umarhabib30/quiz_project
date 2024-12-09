<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Session;
use Auth, DB;
use App\Models\Classes;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    // }
    public function index(){
     $data['active_module'] = "home";
     if(Auth::user()->role == '1'){
         $data['teachers'] = User::where('role', '2')->get()->count();
         $data['students'] = User::where('role', '3')->get()->count();
         $data['classes'] = Classes::get()->count();
         return view('admin.dashboard', $data);
     }
     if(Auth::user()->role == '2'){
        return view('admin.dashboard', $data);
    }
    if(Auth::user()->role == '3'){
        return view('student.dashboard', $data);
    }
}
}
