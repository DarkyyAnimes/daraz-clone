@extends('Layouts.sellerLayout')
@section('content')


    <h1 class="text-2xl font-bold mb-5">Add Product</h1>
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
            <div class="alert bg-green-200 py-2 px-10 alert-success">
                {{ session('message') }}
            </div>
            @endif
            <form method="POST" action="{{route('functions.seller.addproduct')}}" class="bg-white justify-between shadow rounded p-10 flex"  enctype="multipart/form-data">
                @csrf
                <div class="w-4/6 mr-10 shadow p-10">
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Product Name:</label>
                        <input type="text" value="{{old('product_name')}}" class="w-full  border mt-2 rounded p-2 border-gray" name="product_name" placeholder="Mug...">                    
                    </div>                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Product Description:</label>
                        <textarea type="text"  value="{{old('product_name')}}" class="w-full  border mt-2 rounded p-2 border-gray" name="product_description" placeholder="This product is very very good product..." rows="10"></textarea>                    
                    </div>                                                       
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">In Stock :</label>
                        <select name="product_stock" class="block w-full  border border-gray rouded p-2 mt-2"  id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Free delivery :</label>
                        <select name="product_delivery" class="block w-full border border-gray rounded p-1 mt-2" id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>                    
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Warrenty :</label>
                        <select name="product_warrenty" id="" class="block w-full border border-gray rounded p-1 mt-2" >
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>                    
                </div>
                <div class="w-2/6 relative shadow mb-5 px-10">
                    <div class="grid grid-cols-1 mt-5 mx-7">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Upload Banner Photo</label>
                          <div class='flex items-center justify-center w-full'>
                              <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-orange-300 group'>
                                  <div class='flex flex-col items-center justify-center pt-7'>
                                    <svg class="w-10 h-10 text-orange-400 group-hover:text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class='lowercase text-sm text-gray-400 group-hover:text-orange-600 pt-1 tracking-wider'>Select a photo</p>
                                  </div>
                                <input type="file" name="product_banner_image" class="hidden" />
                              </label>
                          </div>
                      </div>
                   <div action="" class=" mt-5 mb-2 relative">  
                        <label class="font-bold font-medium block"  for="product_name ">Product Category :</label>
                        <input type="text" id="input" placeholder="Categories..." name="" class="poppins-regular border my-2 rounded p-2 border-gray px-5 w-full py-2 focus:outline-none" autocomplete="off">                               
                        <input type="number" value=" " id="categoryid"  name="category_id" class="hidden poppins-regular border my-2 rounded p-2 border-gray px-5 w-full py-2 focus:outline-none" autocomplete="off">                               
                        <ul class="buttons-options block absolute z-50 top-[70px] w-full  left-0" id="display_data">                                       
                        </ul>
                    </div>                                          
                    <div class="form-control relative mb-5">
                        <label class="font-bold font-medium" for="product_name ">Orignal Price :</label>
                        <input type="number" value="{{old('product_orignal_price')}}" name="product_orignal_price" class="w-full   border mt-2 rounded p-2 border-gray" name="product_orignal_price" placeholder="product category">                                           
                    </div>   
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Selling Price :</label>
                        <input type="number" name="product_selling_price" class="w-full  border mt-2 rounded p-2 border-gray" name="product_selling_price" placeholder="12">                    
                    </div>   
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_name">Featured :</label>
                        <select name="product_featured" id="" class="block w-full border border-gray rounded p-1 mt-2" >
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div> 
                    <div class="form-control mb-5">
                        <label class="font-bold font-medium" for="product_onsale">On Sale :</label>
                        <select name="product_onsale" id="" class="block w-full border border-gray rounded p-1 mt-2" >
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div> 
                    <div class="form-control mb-5 absoute bottom-0 flex gap-2">
                        <button type="submit" id="submit_form" class="py-2 px-10 bg-green-500 rounded text-white ">Publish</button>
                        <button class="py-2 px-10 bg-blue-500 rounded text-white ">Draft</button>
                    </div>   
                </div>
            </form>
        
        @endsection
        
@push('scripts')
<script>
  let form = document.querySelector('form');
    let submitButton = document.getElementById('submit_form');
    let categoryInput = document.getElementById('categoryid');
    // Prevent form submission when Enter key is pressed
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default behavior of the Enter key
        }
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission behavior
    });

    // Add click event listener to the submit button
    submitButton.addEventListener('click', () => {
        form.submit(); // Submit the form when the submit button is clicked
    });

    let input = document.getElementById('input');
    let displayData = document.getElementById('display_data');
    input.addEventListener('input', async () => {
        try {
            

            // Get CSRF token from the meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Construct headers object
            const headers = new Headers();
            headers.append('Content-Type', 'application/json');
            headers.append('X-CSRF-TOKEN', csrfToken);

            // Fetch data from the server using AJAX
            const response = await fetch(`/ecomLaravel/search?category=${input.value}`, {
                method: 'GET',
                headers: headers
            });

            // Check if the request was successful
            if (!response.ok) {
                throw new Error('Error fetching data');
            }

            // Parse the response JSON
            const data = await response.json();
            
         
            if (data) {
                displayData.innerHTML = "";
                data.forEach((value, index, array) => {
                    let li = document.createElement('li');
                    li.classList.add('bg-white', 'w-full', 'px-5', 'py-2', 'shadow-lg', 'border-b', 'border-gray', 'option_data')
                    li.textContent = value.category_name;
                    li.setAttribute('id', value.id)
                    displayData.appendChild(li);
                });

                let currentPosition = -1;

                
            
            // Add keydown event listener outside the input event listener
            input.addEventListener('keydown', (event) => {
                let allData = document.querySelectorAll(".option_data");

                allData.forEach((value, index, array) => {
                    value.classList.remove('active'); // Remove 'active' class from all items

                    switch (event.key) {
                        case 'ArrowUp':
                            currentPosition = Math.max(0, currentPosition - 1); // Ensure currentPosition doesn't go below 0
                            break;
                        case 'ArrowDown':
                            currentPosition = Math.min(allData.length - 1, currentPosition + 1); // Ensure currentPosition doesn't exceed the length of the array
                            break;
                        case 'Enter':
                            categoryInput.value = allData[currentPosition].id;                            
                            input.value = allData[currentPosition].innerHTML;
                            displayData.innerHTML = "";
                            break;
                        default:
                            break;
                    }

                    if (index === currentPosition) {
                        value.classList.add('active'); // Add 'active' class to the current item
                    }
                });
            });

        }
// Remove the keydown listener from here


            if(input.value == ""){
                displayData.innerHTML = "";
            }
            
            // Log the data to the console
        } catch (error) {
            console.error('Error:', error);
        }
    });

</script>

@endpush
        