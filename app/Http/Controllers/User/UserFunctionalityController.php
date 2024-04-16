<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addtocart;
use App\Models\Seller;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use Carbon\Carbon;
use Auth;
use Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

class UserFunctionalityController extends Controller
{
    public function add_to_cart(Request $request, $id){
        if(Auth::user()){
            $quantity = $request->number_of_product;
            $user = Auth::user();
            $product = Product::find($id);
            $seller_id = $product->seller_id;            
            Addtocart::updateOrCreate(['product_id'=>$product->id],[
                'user_id'=>$user->id,
                'product_id'=>$product->id,
                'seller_id'=>$seller_id,
                'quantity'=> $quantity
            ]);
    
            return redirect()->back()->with([
                'product_message'=>'Product Added to Cart Succesfully'
            ]);
        }else{
            return redirect()->route('admin.login');
        }
    }

    public function remove_from_cart(Request $request,$id){   
        
        $cart = Addtocart::find($id);

        if($cart){
             if(Auth::user()->id == $cart->user_id){
                $cart->delete();
                return redirect()->back()->with([
                    'message'=>"Item Removed Successfully"
                ]);
            }else{
                return redirect()->back()->with([
                    'message'=>"Item not found"
                ]);
            }
        }else{
            return redirect()->back()->with([
                'message'=>"Item not found"
            ]);
        }     
    }
    
    public function checkout(Request $request){
        try {
            $req_data = $request->all();
            
            // Prepare response data
            $data = [
                'message' => "success",
                'url' => route('user.checkout.get'),
                'data'=>$req_data
            ];
    
          
    
            // Return JSON response with the success message and URL, and redirect status
            return response()->json($data, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


   
    public function checkout_data(Request $request){
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


        
        

        return view('User.checkout',[
            'user_image'=>$user->image_path,
            'name'=>$user->name,                
            'items'=>$items,
            'total_price'=>$total_price,
            'cart'=>$cartItems
        ]);
    }

    public function cart_checkout(Request $request, $id){
        $cart = Addtocart::find($id);
        $product  = Product::find($cart->product_id);

        $price = $product->product_selling_price;

        $quantity  = $cart->quantity;     
        $cart_id = $cart->id;
        
        return view('User.checkout' ,[
            'item'=>$product,
            'quantity'=>$quantity,
            'cart'=>$cart
        ]);
    }

    public function esewa_success(Request $request){
        $data = $request->query('data');
        $encodedData = json_decode(base64_decode($data));
       
        function extractValues($inputString)
    {
        // Split the string by '||' to get individual key-value pairs
        $keyValuePairs = explode("||", $inputString);

        // Initialize an empty array to store the extracted values
        $extractedValues = [];

        // Iterate through each key-value pair
        foreach ($keyValuePairs as $pair) {
            // Split each key-value pair by '=' to separate key and value
            $pairArray = explode("=", $pair);

            // If the pair has two elements (i.e., it's a valid key-value pair)
            if (count($pairArray) === 2) {
                // Extract the key and value
                $key = $pairArray[0];
                $value = $pairArray[1];

                // Check if the key is one of 'p', 's', 'c', or 'u'
                if (in_array($key, ['p', 's', 'c', 'u'])) {
                    // Push the value to the extracted values array
                    $extractedValues[$key] = $value;
                }
            }
        }

        // Return the extracted values array
        return $extractedValues;
    }

        $payment_details = extractValues($encodedData->transaction_uuid);

       

        $seller = Seller::find($payment_details['s']);
        $user = User::find($payment_details['u']);

        $product = Product::find($payment_details['p']);

        $cart = Addtocart::find($payment_details['c']);

        if($cart){
            $order = Order::updateOrCreate(["order_id"=>$encodedData->transaction_code],[
                'user_id'=>$user->id,
                'seller_id'=>$seller->id,
                'product_id'=>$product->id,
                'order_id'=> $encodedData->transaction_code,
                'quantity'=>$cart->quantity
            ]);
          
            $user = User::find($payment_details['u']);
    
            $cart->delete();
            $data = [
                'user'=>$user,
                'seller'=>$seller,
                'product'=>$product,
                'order'=>$order
            ];
            
            
            return view('User.payment_success', $data);
        }else{
            return redirect(route('order.products'));
        }        
    }
    
    public function product_received(Request $request, $id){
        $order = Order::find($id);
        
        $order->done_b_user = "true";                                        
        $order->save();
        return redirect()->back()->with([
            'message'=>'Thanks for Purchasing From us'
        ]);
    }
    
        
    public function email_verify(Request $request) {
        $request->validate([
            'email' => 'email|required'
        ]);
        
        $user = Auth::user();
        if($user->email_verified_at == null){

            $token = Str::random(40);
            
            
            $baseUrl = url("/");
            $verifyRoute = route('verify.email.functional');
            $url = "$verifyRoute?token=$token";
            
            // Get the current time and 90 seconds later
            $currentTime = Carbon::now();
            $time_90_seconds_later = $currentTime->addSeconds(90);
            
            $user->remember_token = $token;
            $user->email_verified_at = $currentTime;
    
            $user->save();
            $data = [
                "url" => $url,
                
            ];
    
            Mail::send("User.Mail.verify_mail", ['data' => $data,"user"=>$user,"verificationUrl"=>$url  ], function ($message) use ($request, $data) {
                $message->to($request->email, 'Sujit ale')
                        ->subject('Email Verification'); // Set the email subject
            });
    
            return redirect(route('resend.verify.email.interface'))->with([
                'message'=>"Mail Sent"
            ]);
        }else{
            return redirect(route('resend.verify.email.interface'))->with([
                'message'=>'Mail Already Sended Or Resend Mail'
            ]);
        }
    }

        
    public function resend_email_verify(Request $request){
        $currentTime = Carbon::now();
        $user = Auth::user();

        // Check if the user has recently requested a resend (within 90 seconds)
        $recentResend = $user->email_verified_at && $user->email_verified_at->addSeconds(90)->isFuture();
        if ($recentResend) {
            return redirect()->back()->with([
                'message' => 'Please wait for 90 seconds before resending.'
            ]);
        }

        $token = Str::random(40);

        $verifyRoute = route('verify.email.functional');
        $url = "$verifyRoute?token=$token";
        
        // Update user data
        $user->remember_token = $token;
        $user->email_verified_at = $currentTime;
        $user->save();

        $data = [
            "url" => $url,
        ];

        // Send email
        Mail::send("User.Mail.verify_mail", ['data' => $data, "user" => $user, "verificationUrl" => $url], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                    ->subject('Email Verification'); // Set the email subject
        });

        return redirect(route('resend.verify.email.interface'))->with([
            'message' => "Mail Sent"
        ]);
    }

    public function email_verified(Request $request){
        $token = $request->query('token');
        $user = Auth::guard()->user();
        if($user->remember_token != $token && !$token){
            return redirect("/");
        }else{
            $user->verified_user = true;    
            $user->save()    ;
            return redirect(route("order.products"));
        }
        return $token;
    }
}

