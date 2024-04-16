@extends('Layouts.productLayout')
@section('content')
<div class="container mx-auto">
    <div class="store-profile pt-5">
        <div class="store-details flex gap-5 p-5 ml-5 bg-white w-[30%]">            
            <div class="store-image">
                <img src="{{$seller->store_image_path }}" class="max-w-[80px] aspect-square object-cover rounded-full" alt="Logo">            
            </div>
            <div class="store-data">
                <h1>{{$seller->store_name}}</h1>
                <h1 class="text-sm text-gray-500">{{count($products)}} Products</h1>
                <h1 class="text-sm text-gray-500">Located In: {{$seller->store_address}}</h1>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto  mt-5">
    <div class="grid gap-2 grid-cols-6 min-h-[300px]">
        @isset($products[0])            
        <div class="bg-red-600 row-span-2 col-span-2 ">
                    <a href="{{route('product', ["id"=>$products[0]->id])}}">
                    <div class="shop-item-featured-card">
                        <div class="overlay"></div>
                        <img src="{{$products[0]->product_banner }}" alt="">
                        <div class="body">
                            <h2 class="text-white text-2xl"><span class=" font-bold">Rs. {{$products[0]->product_selling_price}}</span> {{$products[0]->product_name}}</h2>
                        </div>
                    </div>
                </a>
                </div>
        @endisset
        @isset($products[1])            
        <div class="bg-green-600 row-span-2 col-span-2 grid-rows-2">
                    <a href="{{route('product', ["id"=>$products[1]->id])}}">
                    <div class="shop-item-featured-card">
                        <div class="overlay"></div>
                        <img src="{{$products[1]->product_banner }}" alt="">
                        <div class="body">
                            <h2 class="text-white text-2xl"><span class=" font-bold">Rs. {{$products[1]->product_selling_price}}</span> {{$products[1]->product_name}}</h2>
                        </div>
                    </div>
                </a>
                </div>
            @endisset
        @isset($products[2])               
        <div class="bg-white p-5 col-span-2 row-span-1">
                <a href="{{route('product', ["id"=>$products[2]->id])}}">
                    <div class="flex gap-5 items-center justify-between">
                        <div class="w-[60%]">
                        <img src="{{$products[2]->product_banner}}" alt="">
                    </div>
                    <div>
                        <h1 class="text-2xl">{{$products[2]->product_selling_price}}</h1>
                    </div>
                </div>
            </a>    
            </div>
        @endisset
        @isset($products[3])  
        <div class="bg-white row-span-1 p-5">
            <a href="{{route('product', ["id"=>$products[3]->id])}}">
                <img src="{{$products[3]->product_banner}}" alt="">
                <h1 class="text-center text-orange-600 mt-2">Rs. {{$products[3]->product_selling_price}}</h1>
            </a>
        </div>
        @endisset
        @isset($products[4])  
        <div class="bg-white row-span-1 p-5">
            <a href="{{route('product', ["id"=>$products[4]->id])}}">
            <img src="{{$products[4]->product_banner}}" alt="">
            <h1 class="text-center text-orange-600 mt-2">Rs. {{$products[4]->product_selling_price}}</h1>
            </a>
        </div>
        @endisset
    </div>

    <div class="container mx-auto store">
        <div class=" pb-8 border-b border-gray-300 p-2">
            <div class="grid gap-2 grid-cols-6">               
               @foreach ($products as $product)                   
                <a href="{{route('product', ['id'=>$product->id])}}">
                    <x-product-item title="{{ $product->product_name }}" price="{{ $product->product_original_price }}" banner="{{ $product->product_banner }}" orignalprice="{{ $product->product_selling_price }}"  />
                </a>
               @endforeach               
            </div>
        </div>
    </div>
@endsection