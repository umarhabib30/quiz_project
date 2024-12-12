<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use App\Models\Classes;
use Auth;
use Hash;
use Storage;
class SettingController extends Controller
{

    private $type   =  "admins";
    private $singular = "Admin";
    private $plural = "Admins";
    private $view = "admin.users.";
    private $db_key   =  "id";
    private $action   =  "admin/users";
    private $directory  =   '/public/images';
    private $perpage   =  10;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
        $this->middleware('auth');
    }
    public function showSettings()
    {
        $data['stripeKey'] = Setting::where('key', 'stripe_key')->value('value');
        $data['stripeSecret'] = Setting::where('key', 'stripe_secret')->value('value');
        $data['paypalKey'] = Setting::where('key', 'paypal_key')->value('value');
        $data['paypalSecret'] = Setting::where('key', 'paypal_secret')->value('value');
        $data['active_module'] = "home";
        return view('admin.setting', $data);
    }

    public function updateSettings(Request $request)
    {
        $request->all();
        Setting::updateOrCreate(['key' => 'stripe_key'], ['value' => $request->stripe_key]);
        Setting::updateOrCreate(['key' => 'stripe_secret'], ['value' => $request->stripe_secret]);
        Setting::updateOrCreate(['key' => 'paypal_key'], ['value' => $request->paypal_key]);
        Setting::updateOrCreate(['key' => 'paypal_secret'], ['value' => $request->paypal_secret]);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }

    public function showProfile()
    {
     // $data['class'] = Classes::where('id', Auth::user()->class_id)->first();
     $data['active_module'] = "home";
     return view('admin.profile', $data);
 }

 public function updateProfile(Request $request)
 {
    // Validate incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|in:Male,Female',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'nullable|string|min:8|confirmed', // Ensures password and confirm_password match
    ]);

    try {
        $user = Auth::user();

        // Update basic fields
        $user->name = $validatedData['name'];
        $user->phone = $validatedData['phone'] ?? $user->phone;
        $user->gender = $validatedData['gender'] ?? $user->gender;

        // Handle image upload
        if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Storage::putFile($this->directory, $file);
                $user->image = basename($filename);
            }
        // Handle password if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Save updated user
        $user->save();

        // Redirect based on user role
        if ($user->role == '0' || $user->role == '1') {
            return redirect()->to('user/profile')->with('success', 'Profile updated successfully.');
        }
        if ($user->role == '2' || $user->role == '3') {
            return redirect()->to('home')->with('success', 'Profile updated successfully.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
    }
}


}
