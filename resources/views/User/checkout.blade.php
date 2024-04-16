@extends('Layouts.productLayout')
@section('content')
<div class="container mx-auto">
    <h1 class="text-4xl  font-bold mt-10">Check Out</h1>
    
    <div class="md:grid mt-5 grid-cols-6">
        <div class="col-span-4 mr-5">
           
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
                        </tr>
                    </thead>
                    <tbody> 
                      
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="p-4">
                                    <img src="{{ $item->product_banner }}" class="w-16 md:w-32 max-w-full max-h-full" alt="{{ $item->product_name }}">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $item->product_name }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">                                    
                                        <div>
                                            <p type="number" value="" name="quantity"  class="bg-gray-50 quantites w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1" placeholder="1" required >{{ $quantity }}</p>
                                        </div>                                    
                                    </div>
                                </td>
                                <input type="hidden"  class="product_id" value="{{ $item->id }}">
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{-- Display product price --}}
                                    रु{{ $item->product_selling_price }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{-- Display product price --}}
                                    रु{{ $item->product_selling_price  }}
                                </td>
                              
                            </tr>
                     

                    </tbody>
                </table>
            </div>
            
        </div>        
        <div class="col-span-2 rounded-ld shadow-lg">
            <div class="checkhout-head text-md text-gray-700  bg-gray-50">
                <h1 class="px-4 py-3">Check out</h1>
            </div>
            <div class="checkout_body px-4 py-3">
                <div class="flex items-center gap-2 justify-between">
                    <img src="{{asset('public/admin/img/esewa-fonepay-pvt-ltd-logo-portable-network-graphics-image-brand-cash-on-delivery-logo-removebg-preview.png')}}" class="w-1/3" alt="">
                    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" id="form_data" method="POST">
                        @csrf
                        <input type="hidden" id="amount" name="amount" value="{{$item->product_selling_price * $quantity}}" required>
                        <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
                        <input type="hidden" id="total_amount" name="total_amount" value="{{$item->product_selling_price * $quantity + 140}}" required>
                        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="||p={{$item->id}}||s={{$cart->seller_id}}||c={{$cart->id}}||u={{$cart->user_id}}">
                        <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
                        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="140" required>
                        <input type="hidden" id="success_url" name="success_url" value="{{route('esewa.payment.success')}}" required>
                        <input type="hidden" id="failure_url" name="failure_url" value="{{route('esewa.payment.fail')}}" required>
                        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
                        <input type="hidden" id="signature" name="signature" value=""  required>
                        
                        <button class="bg-green-600 py-2 px-10 text-white rounded cursor-pointer">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>            
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>

    <script>        
        function generateRandomUUID() {
            // Generate a random number between 1000000000 and 9999999999
            const randomNum = Math.floor(Math.random() * 9000000000) + 1000000000;
        
            // Convert the random number to a string
            const uuid = String(randomNum);
        
            return uuid;
        }

        let uuid = generateRandomUUID();
        uuid = `${uuid}`
        uuid += document.getElementById('transaction_uuid').value         
        document.getElementById('transaction_uuid').value = uuid
        let sigString = `total_amount=${document.getElementById('total_amount').value},transaction_uuid=${ uuid },product_code=EPAYTEST`;

        var hash = CryptoJS.HmacSHA256(sigString, "8gBm/:&EnhH.1/q");
        var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);

        document.getElementById('signature').value = hashInBase64;                

    </script>    
@endpush