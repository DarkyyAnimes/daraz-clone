@extends('Layouts.sellerLayout')
@section('content')


    <h1 class="text-2xl font-bold mb-5">Edit Product</h1>
            @if ($errors->any())
            <div class="alert alert-danger ">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="bg-red-200 py-2 px-5 my-2 rounded">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('message'))
            <div class="alert bg-green-200 py-2 px-15 alert-success">
                {{ session('message') }}
            </div>
            @endif
            <form method="POST" action="{{route('functions.seller.updateproduct', ['id'=>$id])}}" class="bg-white justify-between shadow rounded p-10 flex"  enctype="multipart/form-data">
                @csrf
                <div class="w-4/6 mr-10 shadow p-10">
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Product Name:</label>
                        <input type="text" class="w-full  border mt-2 rounded p-2 border-gray" value="{{$product->product_name}}"  name="product_name" placeholder="Mug...">                    
                    </div>                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Product Description:</label>
                        <textarea type="text" class="w-full  border mt-2 rounded p-2 border-gray" value="{{$product->product_description}}" name="product_description" placeholder="This product is very very good product..." rows="10"></textarea>                    
                    </div>                                                       
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_stock">In Stock :</label>
                        <select name="product_stock" class="block w-full border border-gray rounded p-2 mt-2">
                            <option value="yes" {{ $product->product_stock == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $product->product_stock == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_delivery">Free delivery :</label>
                        <select name="product_delivery" class="block w-full border border-gray rounded p-2 mt-2">
                            <option value="yes" {{ $product->product_delivery == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $product->product_delivery == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_warrenty">Warranty :</label>
                        <select name="product_warrenty" class="block w-full border border-gray rounded p-2 mt-2">
                            <option value="yes" {{ $product->product_warrenty == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $product->product_warrenty == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    
                </div>
                <div class="w-2/6 relative shadow px-10">
                    <div class="grid grid-cols-1 mt-5  mb-5">
                        <img src="{{$product->product_banner}}" class="max-w-[100%] w-full object-cover aspect-square" id="image_banner_product" alt="">                        
                        <input type="file" name="product_banner_image" id="file_image" class="mt-2" />
                    </div>
                    <div class="form-control relative mb-5">
                        <label class="font-bold font-medium" for="product_category">Category :</label>
                        <input type="text" name="product_category" class="w-full border mt-2 rounded p-2 border-gray" id="product_category" placeholder="Product Category">
                        <select id="category-dropdown" class="absolute z-50 bg-white shadow-lg border-t-2 border-orange-600 w-full rounded p-2" style="display: none;">
                            <div id="category-list" name="product_category" >
                                <!-- Categories will be populated here dynamically -->
                            </div>
                        </select>
                    </div>
                    <div class="form-control relative mb-5">
                        <label class="font-bold font-medium" for="product_name ">Orignal Price :</label>
                        <input type="number" value="{{$product->product_original_price}}" name="product_orignal_price" class="w-full   border mt-2 rounded p-2 border-gray" name="product_orignal_price" placeholder="product category">                                           
                    </div>   
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Selling Price :</label>
                        <input type="number" name="product_selling_price" value="{{$product->product_selling_price}}" class="w-full  border mt-2 rounded p-2 border-gray" name="product_selling_price" placeholder="12">                    
                    </div>   
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_featured">Featured :</label>
                        <select name="product_featured" class="block w-full border border-gray rounded p-1 mt-2">
                            <option value="yes" {{ $product->product_featured == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $product->product_featured == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_onsale">On Sale :</label>
                        <select name="product_onsale" class="block w-full border border-gray rounded p-1 mt-2">
                            <option value="yes" {{ $product->product_onsale == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ $product->product_onsale == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_onsale">Product Status :</label>
                        <select name="product_status" class="block w-full border border-gray rounded p-1 mt-2">
                            <option value="active" {{ $product->product_onsale == 'yes' ? 'selected' : '' }}>active</option>
                            <option value="inactive" {{ $product->product_onsale == 'no' ? 'selected' : '' }}>In active</option>
                        </select>
                    </div>
                    
                    <div class="form-control mb-5 absoute bottom-0 flex gap-2">
                        <button type="submit" class="py-2 px-10 bg-green-500 rounded text-white ">Publish</button>
                        <button class="py-2 px-10 bg-blue-500 rounded text-white "> Draft</button>
                    </div>   
                </div>
            </form>
        
        @endsection
        
@push('scripts')
<script>
    const fileInput = document.getElementById('file_image');
const imageElement = document.getElementById('image_banner_product');

fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Get the selected file

    // Check if a file is selected
    if (file) {
        const reader = new FileReader(); // Create a new FileReader object

        // Set up event listener for when file reading is completed
        reader.onload = (e) => {
            // Set the src attribute of the image element to the data URL of the loaded image
            imageElement.src = e.target.result;
        };

        // Read the contents of the selected file as a data URL
        reader.readAsDataURL(file);
    }
});


    const inputField = document.getElementById('product_category');
    const dropdown = document.getElementById('category-dropdown');

    // Add event listener to input field
    inputField.addEventListener('input', function() {
        // Get CSRF token from the meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Construct headers object
        const headers = new Headers();
        headers.append('Method', 'GET');
        headers.append('X-CSRF-TOKEN', csrfToken);
        headers.append('accepts', 'application/json');

        // Fetch categories from the server using AJAX
        fetch(`/ecomLaravel/search?category=${inputField.value}`, {
                method: 'GET',          
                headers: headers
            })
            .then(response => response.json())
            .then(data => {
                // Clear previous options
                dropdown.innerHTML = '';
                
                // Populate the dropdown with new options
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.textContent = category.category_name;
                    option.value = category.id;
                    dropdown.appendChild(option);
                });

                // Show the dropdown
                dropdown.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    });

    // Handle change event on dropdown
    dropdown.addEventListener('change', function() {
        // Update input field with the selected value
        inputField.value = dropdown.value;

        // Hide the dropdown
        dropdown.style.display = 'none';
    });

    // Hide dropdown when user clicks outside the input field and dropdown
    document.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target) && event.target !== inputField) {
            dropdown.style.display = 'none';
        }
    });
</script>

@endpush
        