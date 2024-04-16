
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
                                        Transaction Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ordered By
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delivering Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $product)                                    
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{$product['product']}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{$product['trasaction']}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$product['user']}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$product['status']}}
                                        </td>
                                        <td class="px-6 items-center flex py-4">
                                            <a href="{{route('view.seller.pending.done',["id" => $product['order_id']])}}"><div class="edit bg-green-600 px-10 py-2 text-white mr-4 rounded">Done</div></a>                                         
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
       
@endsection