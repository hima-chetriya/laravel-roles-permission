<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    
    public function index()
    {

    }

 
    public function ChangePassword()
    {
        // dd("test");
        return view('auth.change-password');
    }

    public function changePasswordSave(Request $request)
    {
        //  dd("test");
        // $request->validate([
        //     'current_password' => 'required|string',
        //     'new_password' => 'required|confirmed|min:8|string'
        // ]);
        $auth = Auth::User();
        // dd($auth);

        // The passwords matches
        if (!Hash::check($request->password, $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }

        // Current password and new password same
        if (strcmp($request->password, $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }
    


    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
    }

  
    public function edit(string $id)
    {
        //
    }

 
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        //
    }
}
