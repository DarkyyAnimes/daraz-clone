<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_no' => 'numeric|required',
            'gender' => 'required',
            'address' => 'required',
            'image_path' => 'required', // Ensure it's an image file
            'password' => 'required|confirmed'
        ]);

        // Attempt to upload the file
        try {
            // Check if a file has been uploaded
            if ($request->hasFile('image_path')) {
                $fileName = time() . '-user.' . $request->file('image_path')->getClientOriginalExtension();
                $request->file('image_path')->storeAs('uploads', $fileName);
        
                // Continue with user creation
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_no' => $request->phone_no,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'image_path' => $fileName,
                    'password' => $request->password
                ]);
        
                // Handle successful user creation
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect('/');
                } else {
                    return redirect()->back()->with(['message' => 'User Created Successfully']);
                }
            } else {
                return redirect()->back()->with(['message' => 'No file uploaded']);
            }
        } catch (\Exception $e) {
            // Handle file upload error
            return redirect()->back()->with(['error' => 'File upload failed: ' . $e->getMessage()]);
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if($user){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect('/');
            }else{
                return redirect()->back()->with([
                    'message'=>"Invalid Credentials"
                ]);
            }
        }else{
            return redirect()->back()->with([
                'message'=>"User Not Exist"
            ]);
        }
    }

}
