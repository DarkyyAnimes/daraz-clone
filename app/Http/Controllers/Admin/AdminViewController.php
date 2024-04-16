<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use App\Models\Seller;
use App\Models\Category;
use Auth;
class AdminViewController extends Controller{

 


    public function login(){
        return view('Admin.login');
    }

    public function index(){

        $admin = Auth::guard('admin')->user();        
        $seller = Seller::all();        
        $products = Product::all();
        $data = [
            "admin"=>$admin,
            'sellers'=>$seller,
            "products"=>$products
        ];
        return view('Admin.index', $data);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->back();
    }

    public function users(){
        $admin = Auth::guard('admin')->user();  
        $users = User::all();
        $data = [
            "admin"=>$admin,
            "users"=>$users,          
        ];
        return view('Admin.users', $data);
    }

    public function category(){
        $categories = Category::all();
        $admin = Auth::guard('admin')->user();  
        $data = [
            "admin"=>$admin,
            'categories'=>$categories
        ];
        return view('Admin.category', $data);
    }

    public function editcategory($id){



        $category = Category::find($id);
        $admin = Auth::guard('admin')->user();          
        if($category){
            $categories = Category::all();
            $parentCategories = [];
        
            foreach($categories as $category){
                if($category->parent_category === null){
                    $parentCategories[] = $category;
                }
            }
    
    
            $data = [
                "admin"=>$admin,
                "categories" => $parentCategories,
                "category"=>$category
            ];
            return view('Admin.edit-category', $data);
        }else{
            return redirect(route("admin.dashboard"));
        }
    }

    public function addcategory(){
        $categories = Category::all();
        $parentCategories = [];
    
        foreach($categories as $category){
            if($category->parent_category === null){
                $parentCategories[] = $category;
            }
        }
        
    
        $admin = Auth::guard('admin')->user();  
        $data = [
            "admin" => $admin,
            "categories" => $parentCategories
        ];
    
        return view('Admin.add-category', $data);
    }
    

    public function addslider(){
        $admin = Auth::guard('admin')->user();  
        $data = [
            "admin"=>$admin,
        ];
        return view('Admin.add-slider', $data);
    }
}
