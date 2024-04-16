<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Addtocart;
use App\Models\Slider;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;

class UserViewController extends Controller
{
    public function index(){
        $products = Product::all();

        $categories = Category::all();
        $parent_categories = Category::whereNull('parent_category')->get(); // Assuming parent_category is a foreign key, this line should be corrected.
        
        $ac_category_arr = [];
        
        foreach ($parent_categories as $parent_category) {
            $tempArr = [];
            $tempArrchild = [];
        
            foreach ($categories as $child_category) {
                if ($child_category->parent_category == $parent_category->id) {
                    $tempArrchild[] = $child_category;
                }
            }
        
            $tempArr['parent_category'] = $parent_category;
            $tempArr['child_categories'] = $tempArrchild;
        
            $ac_category_arr[] = $tempArr; // Pushing $tempArr to $ac_category_arr
        }

        $sliders = Slider::all();

        $sellers = Seller::all();

        $featuredMall = Seller::where('isfeatured', 'yes')->get();

        
        $onsale = Product::where('product_onsale', 'yes')->get();
        if(Auth::check()){
            $user = Auth::user();
            $cartItems = Addtocart::where(['user_id'=>$user->id])->get();
                    
            return view('User.index',[
                'user_image'=>$user->image_path,
                'name'=>$user->name,
                'products'=>$products,
                'categories'=>$categories,
                'menus'=>$ac_category_arr,
                'sellers'=>$sellers,
                'featured'=>$featuredMall,
                'sale'=>$onsale,
                'sliders'=>$sliders,
                'cart'=>$cartItems
            ]) ;
        }else{
            return view('User.index' , [
                'products'=>$products,
                'categories'=>$categories,
                'sellers'=>$sellers,
                'menus'=>$ac_category_arr,
                'featured'=>$featuredMall,
                'sale'=>$onsale,
                'sliders'=>$sliders
            ]);
        }
    }
    
    public function login(){        
        return view('User.login') ;
    }

    public function register(){
        return view('User.register');
    }

    public function product($id){
        $product = Product::find($id);
        if($product != NULL){

            $productName = $product->product_name;
            $productDescription = $product->product_description;
            $productDelivery = $product->product_delivery;
            $productWarrenty = $product->product_warranty;
            $productBanner = $product->product_banner;
            $productOrignalPrice = $product->product_original_price;
            $productSellingPrice = $product->product_selling_price;
            $productInstock = $product->product_instock;
            $seller = Seller::find($product->seller_id);

            $category = Category::find($product->category_id);

         $category_info = [];
          if ($category->parent_category !== null) {
            $parent_category = Category::find($category->parent_category);
            $category_info = [
                'parent_category' => $parent_category->category_name,
                'current_category' => $category->category_name,                
            ];                          
          }else{
            $category_info= [
                'current_category' => $category->category_name
            ];
          }
    
            if(Auth::user()){
    
                $user = Auth::user();
                $cartItems = Addtocart::where(['user_id'=>$user->id])->get();
        
        
                $data = [
                    'user_image'=>$user->image_path,
                    'name'=>$user->name,                                                                                                
                    "productName"=> $productName,
                    "productDescription"=>$productDescription,
                    "productDelivery"=> $productDelivery,
                    "productWarrenty"=> $productWarrenty,
                    "productBanner"=> $productBanner,
                    "productOrignalPrice"=>$productOrignalPrice,
                    "productSellingPrice"=>$productSellingPrice,
                    "productInstock"=>$productInstock ,
                    "seller"=>$seller         ,
                    "product"=>$product,
                    'cart'=>$cartItems,
                    "category_info" => $category_info
                ];
                return view('User.product', $data);
            }else{
                $data = [
                    "productName"=> $productName,
                    "productDescription"=>$productDescription,
                    "productDelivery"=> $productDelivery,
                    "productWarrenty"=> $productWarrenty,
                    "productBanner"=> $productBanner,
                    "productOrignalPrice"=>$productOrignalPrice,
                    "productSellingPrice"=>$productSellingPrice,
                    "productInstock"=>$productInstock ,
                    "seller"=>$seller         ,
                    "product"=>$product,                
                    "category_info" => $category_info
                ];
                return view('User.product', $data);
    
            }
        }else{
            return redirect()->back();
        }
    }

    public function store($id){
        $sellers = Seller::find($id);
        $products = $sellers->products;   
        if(Auth::user())   {
            $user = Auth::user();
            $cartItems = Addtocart::where(['user_id'=>$user->id])->get();
            return view('User.store', [
                'user_image'=>$user->image_path,
                'name'=>$user->name,                
                'products'=>$products, 
                'seller'=>$sellers,
              
                
            ] );
        }else{
            return view('User.store', [
                'seller'=>$seller,
                'products'=>$products,                
            ] );            
        }
    }

    public function cart(){
        $user = Auth::user();        
        $cartItems = Addtocart::where(['user_id' => $user->id])->get();        
        $items = [];

        $total_price = 0;        
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $quantity = $item->quantity;
            
            // Create a new cart product array for each item
            $cart_product = [
                'product' => $product,
                'quantity' => $quantity,
                'total_price' => $product->product_selling_price * $quantity ,// Corrected calculation
                'cart_id'=>$item->id
            ];

            // Push the cart product into the items array
            array_push($items, $cart_product);
            $total_price += $cart_product['total_price']; 
        }


        
        

        return view('User.carts',[
            'user_image'=>$user->image_path,
            'name'=>$user->name,                
            'items'=>$items,
            'total_price'=>$total_price,
            'cart'=>$cartItems
        ]);
    }

    public function order_products(Request $request){
        $user = Auth::user(); 
        $orders = $user->orders;       
        $details = [];

        foreach($orders as $order){
            $tempArr = [];
            
            if($order->done_b_seller == "false" || $order->done_b_user == "false"){
                $seller = Seller::find($order->seller_id);
                $user = User::find($order->user_id);
                $product = Product::find($order->product_id);            
                
                $tempArr['seller'] = $seller->store_name;
                $tempArr['user'] = $user->name;
                $tempArr['order_id'] = $order->id;
                $tempArr['status'] = $order->status;
                $tempArr['product'] = $product->product_name;
                $tempArr['product_status'] = $order->done_b_seller;
                $tempArr['received_by_user'] = $order->done_b_user;
                $tempArr['created_at'] = $order->created_at;
                $tempArr['transction'] = $order->order_id;
                
                array_push($details, $tempArr);
            }
        }        

        

        return view('User.ordered_products',[
            'user_image'=>$user->image_path,
            'name'=>$user->name,            
            'details'=>$details
        ]);
    }

    public function category(Request $request, $id){
        $minimum_price = $request->query('minimum_price');
        $maximum_price = $request->query('maximum_price');
    
        $category = Category::with('products')->find($id);
        
               
        
        $viewData = [
            'current_category' => $category->category_name,           
           
        ];
        
        if(Auth::check()){
            $user = Auth::user();
            $viewData['user_image'] = $user->image_path;
            $viewData['name'] = $user->name;
        }
        
        if ($category->parent_category !== null) {


            $parent_category = Category::find($category->parent_category);
            
            $viewData['parent_category'] = $parent_category->category_name;
            $viewData['current_category'] = $category->category_name;
    
            $products = $category->products;

            $filtered_products =[];
            
            if($minimum_price  && $maximum_price){
                foreach($products as $product){
                    if($product->product_selling_price >  intval($minimum_price) && $product->product_selling_price < intval($maximum_price)){
                        array_push($filtered_products, $product);
                    }
                }
                
                
            }                                
           
           if(count($filtered_products) > 0){
               $viewData['products'] =  $filtered_products;
           }

           if(!isset($viewData['products'])){
                $viewData['products'] = $category->products;
            }
            
            return view('User.category', $viewData);            
        } else {
            $products = Category::with('products')
                                ->where('parent_category', $category->id)
                                ->get()
                                ->flatMap(function ($cat) {
                                    return $cat->products;
                                });

            $filtered_products =[];
            
            if($minimum_price  && $maximum_price){
                foreach($products as $product){
                    if($product->product_selling_price >  intval($minimum_price) && $product->product_selling_price < intval($maximum_price)){
                       array_push($filtered_products, $product);
                    }
                }
            }                                
           
           if(count($filtered_products) > 0){

               $viewData['products'] =  $filtered_products;
           }
    
            if(!isset($viewData['products'])){
                $viewData['products'] = $filtered_products;
            }
    
            return view('User.category', $viewData);                       
        }
    }
    
    
    


    public function email_verify_interface(Request $request){
        $user = Auth::guard()->user();
        $data = [
            'user'=> $user
        ];
        return view('User.email_verify_interface', $data);
    }
    
    public function resend_email_verify(){
        $user = Auth::guard()->user();
        $data = [
            'user'=> $user
        ];
        return view('User.resend_mail', $data);

    }
}
