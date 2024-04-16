<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
class AdminAuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:8'
        ]);
    
        // Retrieving admin based on email
        $admin = Admin::where('email', $request->email)->first();
    
        if(!$admin){
            // If admin doesn't exist, redirect back with a message
            return redirect()->back()->with([
                'message'=>'User Doesn\'t Exist'
            ]);
        }else{
            // Attempting to authenticate the admin
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                // If authentication successful, redirect to admin dashboard
                return redirect('/ecom-admin/dashboard');
            }else{
                // If authentication fails, redirect back with a message
                return redirect()->back()->with([
                    'message'=>'Invalid Credentials',                    
                ]); 
            }
        }
    }
    
}
