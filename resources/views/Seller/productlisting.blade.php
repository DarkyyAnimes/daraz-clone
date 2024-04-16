
@extends('Layouts.sellerLayout')
@section('content')
            <div class="">                                            
                <div class="topperformingproduct my-5">                    
                    <h1 class="text-4xl font-bold ">All Products</h1>
                    @if(session('message'))
        <div class="bg-green-100 mt-10 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">message!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
        @endif

        <!-- Display error messages -->
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Errors:</strong>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm mt-10 text-left" id="myTable">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        In Stock
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
                                @foreach ($all_products as $product)                                    
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{$product->product_name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$product->product_instock}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$product->product_original_price}}
                                        </td>
                                        <td class="px-6 items-center flex py-4">
                                            <a href="{{route('view.edit.product', ['id'=>$product->id])}}"><div class="edit bg-blue-500 p-1 text-white mr-4 rounded">Edit <i class="ri-pencil-line"></i></div></a>
                                            <a href="{{route('delete.product', ['id'=>$product->id])}}"><div class="delete cursor-pointer p-1 bg-red-500 text-white rounded">Delete <i class="ri-delete-bin-line"></i></div>                                        </a>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
       
@endsection