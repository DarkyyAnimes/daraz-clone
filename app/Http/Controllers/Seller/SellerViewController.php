<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Seller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
class SellerViewController extends Controller
{
    public function index() {
        $sellerId = Auth::guard('seller')->id(); // Retrieve the ID of the authenticated seller
        $seller = Seller::find($sellerId); // Find the seller by their ID
        $totalProducts = $seller->products()->count(); // Count the total number of products associated with the seller
        $recentlyaddedproduct = $seller->products;                

        return view('Seller.dashboard', [
            'seller' => $seller,
            'total_products' => $totalProducts,
            'recent_product'=>$recentlyaddedproduct
        ]);
    }
    

    public function dashboard() {
        $sellerId = Auth::guard('seller')->id(); // Retrieve the ID of the authenticated seller
        $seller = Seller::find($sellerId); // Find the seller by their ID
        $totalProducts = $seller->products()->count(); // Count the total number of products associated with the seller

        $twoDaysAgo = Carbon::now()->subDays(2);

        $recentlyaddedproduct = $seller->products;                
        $recent_products = [];
        foreach ($recentlyaddedproduct as $key => $product) {
            if ($product->created_at > $twoDaysAgo) {
                // Product was added within the last 2 days
                $recent_products[] = $product;
            }
        }

        $order_count = Order::where('seller_id', $sellerId)->where('done_b_seller', "false")->count();         

        $completed_orders = Order::where('seller_id', $sellerId)->where('done_b_seller', "true")->get(); 
        $product_ids = [];

        foreach ($completed_orders as $key => $order) {
            $product_ids[] = $order->product_id;
        }

        function findMostRepeatedNumbers($arr) {
            // Create an associative array to store counts of each number
            $countMap = [];
            
            // Count occurrences of each number in the array
            foreach ($arr as $num) {
                if (!isset($countMap[$num])) {
                    $countMap[$num] = 0;
                }
                $countMap[$num]++;
            }
            
            // Sort the count map by values (counts) in descending order
            arsort($countMap);
            
            // Get the 5 most repeated numbers
            $mostRepeatedNumbers = array_slice(array_keys($countMap), 0, 5);
            
            return $mostRepeatedNumbers;
        }
        
                
        $popular_products = [];
        $popular_product_ids = findMostRepeatedNumbers($product_ids);

        foreach ($popular_product_ids as $key => $product) {
            $p_db = Product::find($product);
            $popular_products[] = $p_db;
        }



        $completed_order_count = Order::where('seller_id', $sellerId)->where('done_b_seller', "true")->count(); 

        $total_price_single = 0;
        foreach ($completed_orders as $key => $order) {
            $temp = [];
            $product = Product::find($order->product_id);
            $total_price_single += $product->product_selling_price *  $order->quantity;          
        }
      

        return view('Seller.dashboard', [
            'pending_order' => $order_count,
            'completed_order_count' => $completed_order_count,
            'total_products' => $totalProducts,
            'recent_product'=>$recent_products  ,
            'popular_products'=>$popular_products  ,
            'total_sales'=>$total_price_single,
        ]);
    }

    public function allproducts() {
        $sellerId = Auth::guard('seller')->id();
        $seller = Seller::find($sellerId);
        $allproducts = $seller->products()->get();           
        return view('Seller.productlisting',[
            'all_products'=>$allproducts
        ]);
    }

    public function addproduct() {
        return view('Seller.addproduct');
    }

    public function profile() {
        if(Auth::guard('seller')->check()){
            $store_name = Auth::guard('seller')->user()->store_name;
            $store_email = Auth::guard('seller')->user()->store_email;
            $store_banner = Auth::guard('seller')->user()->store_image_path;
            $store_address = Auth::guard('seller')->user()->store_address;
            return view('Seller.profile', [
                'store_name'=>$store_name,
                'store_email'=>$store_email,
                'store_address'=>$store_address,
                'store_banner'=>$store_banner
            ]);
        }else{
            return view('Seller.profile');
        }
    }

    public function register(Request $request){
        return view('Seller.register');
    }

    public function login(Request $request){
        return view('Seller.login');
    }

    public function edit($id){
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        
        return view('Seller.edit-product', [
            'product'=>$product,
            'id'=>$product->id
        ]);
}

    public function pending_orders(Request $request){
        $seller = Auth::guard('seller')->user(); 
        $orders = $seller->orders;
        $details = [];

        foreach($orders as $order){
            $tempArr = [];       
            if($order->done_b_seller == "false"){
                $user = User::find($order->user_id);
                $product = Product::find($order->product_id);            
                
                $tempArr['user'] = $user->name;
                $tempArr['order_id'] = $order->id;
                $tempArr['status'] = $order->status;
                $tempArr['product'] = $product->product_name;
                $tempArr['created_at'] = $order->created_at;
                $tempArr['trasaction'] = $order->order_id;
                
                array_push($details, $tempArr);
            }                              
        }        

        

        return view('Seller.pending',[
                       
            'details'=>$details
        ]);
    }
    public function complete_orders(Request $request){
        $seller = Auth::guard('seller')->user(); 
        $orders = $seller->orders;
        $details = [];

        foreach($orders as $order){
            $tempArr = [];       
            if($order->done_b_seller == "true"){
                $user = User::find($order->user_id);
                $product = Product::find($order->product_id);            
                
                $tempArr['user'] = $user->name;
                $tempArr['order_id'] = $order->id;
                $tempArr['status'] = $order->status;
                $tempArr['product'] = $product->product_name;
                $tempArr['created_at'] = $order->created_at;
                $tempArr['received'] = $order->done_b_user;
                $tempArr['trasaction'] = $order->order_id;
                
                array_push($details, $tempArr);
            }                              
        }        

        

        return view('Seller.complete',[
                       
            'details'=>$details
        ]);
    }

}
