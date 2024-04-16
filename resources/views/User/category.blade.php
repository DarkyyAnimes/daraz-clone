@extends('Layouts.productLayout')
@section('content')
    <div class="container mx-auto">
        <div class="breadcrumb">
            <ul class="text-sm flex my-3">
              <li class="pr-4  text-blue-500">Home</li>       
              <li class="pr-4">/</li>       
              @if (isset($parent_category))                  
                <li class="pr-4  text-blue-500">{{ $parent_category }}</li>       
                <li class="pr-4">/</li>       
              @endif
              <li class="pr-4  text-blue-500">{{ $current_category }}</li>       
            </ul>
          </div>
    </div>
    <div class="container mx-auto">
        <div class="grid gap-5 mt-10 gap-10 grid-cols-9 min-h-screen">
            <div class="col-span-3 p-5 bg-white shadow-lg ">
                <h2 class="text-2xl mb-2">Filters</h2>
                <hr>
                <h2 class="text-xl mt-5">Price</h2>
                <div class="flex mt-2 items-center w-full gap-2 text-center ">
                    <div class=" items-center w-1/2">                      
                        <input type="number" class="border w-full text-sm text-gray-600 rounded p-2  border-gray-400 block" placeholder="min" name="minimum_price ">
                    </div>   
                    <div>-</div>               
                    <div class=" w-1/2">                        
                        <input type="number" class="border w-full text-sm text-gray-600  rounded p-2 border-gray-400 block" placeholder="max" name="minimum_price ">
                    </div>
                    <div class=" w-1/2">                        
                        <button id="category_btn" class="bg-orange-600 text-white py-2 text-sm rounded px-10">Submit</button>
                    </div>
                </div>
                <h2 class="text-xl mt-5">Promotions & Services</h2>
                <div class="flex mt-2 items-center w-full gap-2 text-center hover:bg-gray-100 p-2 border-gray-300 border rounded inline-block">
                   <a href="" class="flex text-sm gap-2"><img src="https://img.alicdn.com/imgextra/i4/O1CN01Tp04IC1x3IWhZt8RK_!!6000000006387-2-tps-72-72.png" class="w-[20px]" alt=""> Free Delivery</a> 
                </div>
                <div class="flex mt-2 items-center w-full gap-3 text-center hover:bg-gray-100 p-2 border-gray-300 border rounded inline-block">
                   <a href="" class="flex text-sm gap-2"><img src="https://img.alicdn.com/imgextra/i4/O1CN01R8MXtY1y3aQsd0VQg_!!6000000006523-2-tps-28-40.png" class="w-[20px] h-[15px]" alt=""> Mega Deals</a> 
                </div>
                <div class="flex mt-2 items-center w-full gap-3 text-center hover:bg-gray-100 p-2 border-gray-300 border rounded inline-block">
                   <a href="" class="flex text-sm gap-2"><img src="https://img.alicdn.com/imgextra/i4/O1CN01pr1AG92A8sM4YKlmy_!!6000000008159-2-tps-72-72.png" class="w-[20px]" alt=""> Warrenty    </a> 
                </div>
            </div>
            <div class="col-span-6 ">
                <p class="text-md mb-5 mt-2">{{count($products)}} Items found for <span class="text-orange-600 ">"{{ $current_category }}"</span></p>
                <hr>
                <div class="grid gap-2 grid-cols-4">
                    @forelse ($products as $product)    
                    <a href="{{ route('product', ['id' => $product->id]) }}">
                        <x-item-cart title="{{ $product->product_name }}" price="{{ $product->product_original_price }}" banner="{{ $product->product_banner }}" orignalprice="{{ $product->product_selling_price }}" />  
                    </a>
                    @empty
                        <p class=" mt-5">No products found.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let btn = document.getElementById('category_btn');

        btn.addEventListener('click', (e) => {
            window.location = '/'
        })
    </script>
@endpush