<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Seller;
use App\Models\Category;
use App\Models\Slider;
use Storage;
use Auth;
class AdminFunctionalityController extends Controller
{
    public function deleteuser($id){
        $user = User::find($id);
        if($user){
            $user->delete();        
            return redirect()->back()->with([
                'message'=>'User deleted Successfully'
            ]);
        }else{
            return redirect()->back()->with([
                'message'=>'User Not Found'
            ]);            
        }
    }

    public function deletecategory($id){
        $category = Category::find($id);
        if($category){
            $category->delete();        
            return redirect()->back()->with([
                'message'=>'Category deleted Successfully'
            ]);
        }else{
            return redirect()->back()->with([
                'message'=>'Category Not Found'
            ]);            
        }
    }
    
    public function addcategory(Request $request){
        $request->validate([
            'category_image'=>'required',
            'category_name'=>'required|string'
        ]);

        if ($request->hasFile('category_image')) {
            // Generate unique file name
            $fileName = time() . '-category.' . $request->file('category_image')->getClientOriginalExtension();
            // Store the file in the 'uploads' directory
            $request->file('category_image')->storeAs('uploads', $fileName);
            // Get the full path to the stored file
            $filePath = storage_path('app/uploads/') . $fileName;
            // Generate the URL using the asset() helper function
            $fileUrl = asset('storage/app/uploads/' . $fileName);

            $category = Category::create([
                'category_name'=>$request->category_name,
                'category_image'=>$fileUrl,
                'parent_category'=>$request->parent_category_name == "null" ? Null : $request->parent_category_name
            ]);

            return redirect()->back()->with([
                'message'=>'Category Added Successfully'
            ]);
        }else{
            return redirect()->back()->with([
                'message'=>'File Not Found'
            ]);
        }
        
    }

    public function deleteseller($id){
        $seller = Seller::find($id);
        if($seller){
            $seller->delete();

            return redirect()->back()->with([
                'message'=>'Seller Removed Succesfully'
            ]);
        }else{
            return redirect()->back()->with([
                'message'=>'Seller Not Found'
            ]);
        }
    }

    public function slider_image(Request $request) {
        $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as per your requirements
        ]);
    
        if ($request->hasFile('slider_image')) {
            $fileName = time() . '-slider.' . $request->file('slider_image')->getClientOriginalExtension();
    
            // Store the file in the 'uploads' directory
            $filePath = $request->file('slider_image')->storeAs('uploads', $fileName);
    
            // Generate the public URL for the stored file
            $fileUrl = Storage::url($filePath);
    
            // Get the authenticated admin's ID
            $id = Auth::guard('admin')->user()->id;
    
            // Create a new slider record
            $slider = Slider::create([
                'slide_image_path' => asset('storage/app/' . $filePath),
                'admin_id' => $id
            ]);
    
            return redirect()->back()->with([
                'message'=>'Slider Image Added Successfully'
            ]);
        } else {
            return redirect()->back()->with([
                'message'=>'Cannot Add Slider'
            ]);
        }
    }


    public function edit_category(Request $request, $id) {
      
        $request->validate([            
            'category_name' => 'required|string'
        ]);
        $category = Category::find($id);
        $fileUrl =null;
        $imagePath = $category->category_image;
            if ($request->hasFile('category_image') && $request->file('category_image')->isValid()) {
                // Generate unique file name
                $fileName = time() . '-category.' . $request->file('category_image')->getClientOriginalExtension();
        
                // Store the file in the 'uploads' directory
                $request->file('category_image')->storeAs('uploads', $fileName);
        
                // Get the full path to the stored file
                $filePath = storage_path('app/uploads/') . $fileName;
        
                // Generate the URL using the asset() helper function
                $fileUrl = asset('storage/app/uploads/' . $fileName);
            } 
            // Update category information
            $category->category_name = $request->category_name;
            $category->category_image =  $fileUrl != null ? $fileUrl : $imagePath;
            // Ensure proper handling of the parent category
            $category->parent_category = $request->parent_category_name == "null" ? null : $request->parent_category_name;
    
            // Save the changes
            $category->save();
    
            return redirect()->back()->with([
                'message' => 'Category Edited Successfully'
            ]);
        
    }
    
    
}
