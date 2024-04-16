<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Order;
use Auth;

class SellerFunctionalityController extends Controller
{
    public function addproduct(Request $request){
        $request->validate([
            'product_name' => 'required|string',
            'product_description' => 'required|string',
            'product_stock' => 'required',
            'product_delivery' => 'required',
            'product_warrenty' => 'required',            
            'product_orignal_price' => 'required', // Make sure this field name matches your database schema
            'product_selling_price' => 'required',
            'product_featured' => 'required',
            'product_banner_image' => 'required',
            'product_onsale' => 'required',
            'category_id' => "required"
        ]);
        
        // Find the category
       
        
        // Retrieve the authenticated seller
        $seller = Auth::guard('seller')->user();
        
        // Check if the seller object is not null (seller is authenticated)
        if ($seller) {
            // Generate a unique file name for the product banner
            $fileName = time() . '-product.' . $request->file('product_banner_image')->getClientOriginalExtension();
            // Store the file in the 'uploads' directory
            $request->file('product_banner_image')->storeAs('uploads', $fileName);
            // Get the full path to the stored file
            $filePath = storage_path('app/uploads/') . $fileName;
            // Generate the URL using the asset() helper function
            $fileUrl = asset('storage/app/uploads/' . $fileName);
            
            // Create a new product
            $product = Product::create([
                'product_banner' => $fileUrl,
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_instock' => $request->product_stock,
                'product_onsale' => $request->product_onsale,
                'product_delivery' => $request->product_delivery,
                'product_warranty' => $request->product_warrenty,
                'product_original_price' => $request->product_orignal_price, // Check the field name
                'product_selling_price' => $request->product_selling_price,
                'product_featured' => $request->product_featured,
                'seller_id' => $seller->id, // Assign the seller ID here
                'category_id' => $request->category_id, // Assign the category ID here
            ]);
        
            // Redirect back with success message
            return redirect()->back()->with([
                'message' => 'Product Added Successfully'
            ]);
        } else {
            // Handle the case where the seller object is null (user is not authenticated)
            // You might want to redirect the user to the login page or display an error message
            return redirect()->route('seller.login')->with('error', 'Please log in to add a product');
        }
        
}


public function search(Request $request){
    // Retrieve the category name from the query parameter
    $query = $request->query('category');

    // Search categories based on the category_name field
    $categories = Category::where('category_name', 'like', "%$query%")
                           ->whereNotNull('parent_category')
                           ->get();

    // Return child categories as JSON response
    return response()->json($categories);
}

public function delete($id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with([
            'error' => 'Product not found.'
        ]);
    }

    $product->delete();

    return redirect()->back()->with([
        'message' => 'Product deleted successfully.'
    ]);
}

public function edit(Request $request, $id){

    // Validate the request data
    $request->validate([
        'product_name' => 'required|string',
        'product_description' => 'required|string',
        'product_stock' => 'required',
        'product_delivery' => 'required',
        'product_warrenty' => 'required',
        'product_category' => 'required',
        'product_orignal_price' => 'required',
        'product_selling_price' => 'required',
        'product_featured' => 'required',
        'product_banner_image' => 'required',
        'product_onsale' => 'required'
    ]);

    // Find the product by ID
    $product = Product::find($id);

    if ($product) {
        // Store the uploaded image
        $fileName = time() . '-product.' . $request->file('product_banner_image')->getClientOriginalExtension();
        // Store the file in the 'uploads' directory
        $request->file('product_banner_image')->storeAs('uploads', $fileName);
        // Get the full path to the stored file
        $filePath = storage_path('app/uploads/') . $fileName;
        // Generate the URL using the asset() helper function
        $fileUrl = asset('storage/app/uploads/' . $fileName);
       
        // Fill the product attributes with request data
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_instock = $request->product_stock;
        $product->product_delivery = $request->product_delivery;
        $product->product_warranty = $request->product_warrenty;
        $product->category_id = $request->product_category;
        $product->product_original_price = $request->product_orignal_price;
        $product->product_selling_price = $request->product_selling_price;
        $product->product_featured = $request->product_featured;
        $product->product_status = $request->product_status;
        $product->product_banner = $fileUrl; // Assuming 'product_banner' is the attribute for storing the image file name

        // Save the product
        $product->save();

        return redirect()->back()->with('message', 'Product updated successfully.');
    } else {
        return redirect()->back()->with('message', 'Product not found.');
    }

}

public function pending_orders_done($id){
    $order = Order::find($id);
    $seller = Auth::guard('seller')->user();
    if($order->seller_id != $seller->id){
        return redirect()->back();
    } else {
        // Check if the order is older than 2 days
        if (Carbon::parse($order->created_at)->diffInDays(Carbon::now()) > 2) {
            // Delete the order
            $order->delete();
            return redirect()->back()->with([
                'message' => 'Order deleted successfully (older than 2 days)'
            ]);
        }

        if($order->done_b_user == "succeed"){ 
            $order->done_b_seller = 1;          
            return redirect()->back()->with([
                'message' => 'Product is not received by the User'
            ]);
        } else {
            $order->done_b_seller = 1;
            $order->status = 'succeed';
            $order->save();
            return redirect()->back()->with([
                'message' => 'Done Product Successfully Reached'
            ]);
        }
    }    
}

}
