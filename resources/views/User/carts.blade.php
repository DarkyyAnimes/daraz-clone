@extends('Layouts.productLayout')
@section('content')
<div class="container mx-auto">
    <h1 class="text-4xl  font-bold mt-10">Carts</h1>
    @if(session('message'))
    <div class="bg-green-100 border mt-2 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">message!</strong>
        <span class="block sm:inline">{{ session('message') }}</span>
    </div>
    @endif
    <div class="md:grid mt-5 grid-cols-6">
        <div class="col-span-6 mr-5">
           
            <div class="relative  overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-16 py-3">
                                <span class="sr-only">Image</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Per Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($items as $item)
                            <tr class="bg-white border-b items-center hover:bg-gray-50">
                                <td class="p-4">
                                    <img src="{{ $item['product']->product_banner }}" class="w-16 md:w-32 max-w-full max-h-full" alt="{{ $item['product']->product_name }}">
                                </td>
                                <td class="px-6  font-semibold text-gray-900">
                                    {{ $item['product']->product_name }}
                                </td>
                                <td class="px-6 ">
                                    <div class="flex items-center">                                    
                                        <div>
                                            <input type="number" value="{{ $item['quantity'] }}" name="quantity" id="product_{{ $loop->index }}" class="bg-gray-50 quantites w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1" placeholder="1" required />
                                        </div>                                    
                                    </div>
                                </td>
                                <input type="hidden"  class="product_id" value="{{ $item['product']->id }}">
                                <td class="px-6 items-center font-semibold text-gray-900">
                                    {{-- Display product price --}}
                                    रु{{ $item['product']->product_selling_price }}
                                </td>
                                <td class="px-6 py-4  items-center font-semibold text-gray-900">
                                    {{-- Display product price --}}
                                    रु{{ $item['product']->product_selling_price * $item['quantity'] }}
                                </td>
                                <td class="px-6 flex items-center gap-2 py-4">
                                    <a href="{{route('remove.from.cart', ["id"=>$item['cart_id']])}}" id="{{$item['cart_id']}}" class="font-medium cart_id text-white py-2 px-5 rounded bg-red-600 ">Remove</a>
                                    <a href="{{route('checkout.from.cart', ["id"=>$item['cart_id']])}}" id="{{$item['cart_id']}}" class="font-medium cart_id text-white py-2 px-5 rounded bg-green-600 ">Check Out</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            
        </div>
      
    
</div>

@push('scripts')
    <script>
        let checkout = document.getElementById('check_out');
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function deleteCookie(name) {
            document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
        }
        checkout.addEventListener('click', async () => {
            
            let all_products = Array.from(document.querySelectorAll('.product_id'));
            let quantities = Array.from(document.querySelectorAll('.quantites'));
            let cart_ids = Array.from(document.querySelectorAll('.cart_id'));
            let details = [];

            // Assuming there are equal numbers of products and quantities
            for (let i = 0; i < all_products.length; i++) {
                let product_id = all_products[i].value;
                let quantity = quantities[i].value;
                let cart_id = cart_ids[i].id;
                // Create a new object for each product and quantity
                let product_details = {
                    product_id: product_id,
                    quantity: quantity,
                    cart_id: cart_id
                };

                // Push the new object into the details array
                details.push(product_details);
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
        const response = await fetch('checkout', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify(details),
        });

        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        

        const responseData = await response.json();
      

        // Set cookie after successful response
        deleteCookie('carts');

        setCookie('carts', JSON.stringify(details), 365);

        window.location = responseData.url
        
        } catch (error) {
            console.error('Error:', error);
        }
        });



        
    </script>
@endpush
@endsection
