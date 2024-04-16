
@extends('Layouts.sellerLayout')
@section('content')
        <div class="main bg-white min-h-screen">
            <div class="p-10">
                <h1 class="text-4xl font-bold mb-5">Dashboard</h1>
                <div class="flex gap-10 justify-between">
                    <div class="bg-white w-1/4 shadow p-5">
                        <h1 class="text-2xl font-bold">Total Products</h1>
                        <h6 class="text-xl mt-2 italic">{{$total_products}}</h6>
                    </div>
                    <div class="bg-white w-1/4 shadow p-5">
                        <h1 class="text-2xl font-bold">Pending Orders</h1>
                        <h6 class="text-xl mt-2 italic">{{$pending_order}}</h6>
                    </div>
                    <div class="bg-white w-1/4 shadow p-5">
                        <h1 class="text-2xl font-bold">Completed Order</h1>
                        <h6 class="text-xl mt-2 italic">{{ $completed_order_count }}</h6>
                    </div>
                    <div class="bg-white w-1/4 shadow p-5">
                        <h1 class="text-2xl font-bold">Total Sales</h1>
                        <h6 class="text-xl mt-2 italic">Rs. {{$total_sales}}</h6>
                    </div>
                </div>
                
                <div class="topperformingproduct my-5">
                    <h1 class="text-4xl font-bold">Popular Products</h1>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm mt-10 text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product warranty
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        In Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($popular_products as $product)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$product->product_name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$product->product_warrenty}}
                                    </td>
                                    <td class="px-6 py-4">
                                       {{$product->product_instock}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$product->product_selling_price}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
          
                <div class="topperformingproduct my-5">
                    <h1 class="text-4xl font-bold">Recently Added Products</h1>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm mt-10 text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product warranty
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        In Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_product as $product)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$product->product_name}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$product->product_warranty}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$product->product_instock}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$product->product_selling_price}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
@endsection