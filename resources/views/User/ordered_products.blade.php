@extends('Layouts.productLayout')
@section('content')
@foreach ($details as $detail)
    


<div class="container mx-auto my-5">
  
    @if(session('message'))
        <div class="alert rounded mb-5 bg-green-200 py-2 px-10 alert-success">
            {{ session('message') }}
        </div>
    @endif
   
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
                                : &nbsp;&nbsp;{{$detail['product']}}
                            </td>
                           
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                Seller Name :
                            </th>
                            <td class="px-6 py-4">
                                :&nbsp;&nbsp; {{$detail['seller']}}
                            </td>
                           
                        </tr>
                        <tr class="bg-white">
                            <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                Ordered In
                            </th>
                            <td class="px-6 py-4">
                                : &nbsp;&nbsp;{{$detail['created_at']}}
                            </td>
                           
                        </tr>
                        <tr class="bg-white">
                            <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                Transaction Id
                            </th>
                            <td class="px-6 py-4">
                                : &nbsp;&nbsp;{{$detail['transction']}}
                            </td>
                           
                        </tr>
                        <tr class="bg-white">
                            <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                Product status
                            </th>
                            <td class="px-6 py-4">
                                : @if ($detail['product_status'] == "true")
                                    Ware House
                                    @else
                                    Not Sended By The Seller
                                @endif
                            </td>
                           
                        </tr>
                        <tr class="bg-white">
                            <th scope="row" class=" py-4 font-medium text-gray-900 whitespace-nowrap">
                                @if($detail['received_by_user'] == "false")
                                    <a href="{{route('order.done', ['id'=>$detail['order_id']])}}" class="py-2 px-10 bg-green-600 rounded text-white cursor-pointer">Done</a> 
                                    @else
                                    <p class="py-2 px-10 bg-green-300 rounded text-white cursor-pointer">Done</p> 
                                    @endif                                
                            </th>
                            
                        </tr>
                    </tbody>
                </table>
                
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection