@extends('Layouts.productLayout')
@section('content')
    <div class="container mx-auto my-5">
        <div class="success_container min-h-[20vh] flex items-center justify-center text-center">
            <div>
                <i class="ri-check-double-line text-6xl rounded-full bg-green-400 text-white p-2"></i>
                <h1 class="text-green-800 font-bold text-4xl mt-5">Your Product is Successfully Ordered </h1>
            </div>
        </div>
        <div class="details shadow-lg rounded-lg">
            <div class="bg-gray-50 detail_head w-full px-10 py-4">                
                <h1 class="font-bold text-gray-600">Product Details</h1>
            </div>
            <div class="bg-white px-10 py-4">                                
                <div class="relative overflow-x-auto">
                    <table class="w-full  text-left text-gray-500">
                        <tbody>
                            <tr class="bg-white border-b">
                                <th scope="row" class=" font-bold py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Product Name : 
                                </th>
                                <td class="px-6 py-4">
                                    : &nbsp;&nbsp;{{$product->product_name}}
                                </td>
                               
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Seller Name :
                                </th>
                                <td class="px-6 py-4">
                                    :&nbsp;&nbsp; {{$seller->store_name}}
                                </td>
                               
                            </tr>
                            <tr class="bg-white">
                                <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Ordered In
                                </th>
                                <td class="px-6 py-4">
                                    : &nbsp;&nbsp;{{$order->created_at}}
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>
@endsection