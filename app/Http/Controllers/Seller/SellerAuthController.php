<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Auth;

class SellerAuthController extends Controller
{
    public function register(Request $request){
        try {
            $seller = Seller::where('store_email', $request->email)->first();
            if($seller == NULL){
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email', // Unique email validation
                    'phone_no' => 'numeric|required',            
                    'address' => 'required',
                    'store_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Ensure it's an image file and has allowed extensions
                    'password' => 'required|confirmed',
                    'store_logo'=>'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
                ]);
        
                // Check if a file has been uploaded
                if ($request->hasFile('store_image_path')) {
                    $imageFileName = time() . '-seller.' . $request->file('store_image_path')->getClientOriginalExtension();
                    $logoFileName = time() . '-seller-logo.' . $request->file('store_logo')->getClientOriginalExtension();
            
                    // Store the files
                    $imageFilePath = $request->file('store_image_path')->storeAs('uploads', $imageFileName);
                    $logoFilePath = $request->file('store_logo')->storeAs('uploads', $logoFileName);
            
                    // Generate URLs for the uploaded files
                    $imageUrl = asset('storage/app/' . $imageFilePath);
                    $logoUrl = asset('storage/app/' . $logoFilePath);
            
                    // Create a new seller
                    $seller = Seller::create([
                        'store_name' => $request->name,
                        'store_email' => $request->email,
                        'store_phone_no' => $request->phone_no,                  
                        'store_address' => $request->address,
                        'store_image_path' => $imageUrl,
                        'store_logo'=>$logoUrl,
                        'password' => bcrypt($request->password) // Hash the password
                    ]);
                    
                    // Attempt seller authentication after registration
                    if (Auth::guard('seller')->attempt(['store_email' => $request->email, 'password' => $request->password])) {
                        return redirect('/')->with(['message' => 'Seller Created Successfully']);
                    } else {
                        return redirect()->back()->with(['message' => 'Seller registration failed']);
                    }
                }else{
                     redirect()->back()->with(['message' => 'No file uploaded']);
                }
            } else {
                return redirect()->back()->with(['message' => 'User Already Exists']);
            }
        } catch (\Exception $e) {
            // Handle file upload message
            return redirect()->back()->with(['message' => 'File upload failed: ' . $e->getMessage()]);
        }
    }
    
    public function logout(){
        Auth::guard('seller')->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = Seller::where('store_email', $request->email)->first();

        if($user){
            if(Auth::guard('seller')->attempt(['store_email' => $request->email, 'password' => $request->password])){
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
