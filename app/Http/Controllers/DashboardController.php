<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMeeting;
use App\Models\MeetingEntry;
use App\Events\SendNotification;
use Auth;
use Session;

class DashboardController extends Controller
{
   	public function index() 
    {
        return view('admin.dashboard');
    }
}
