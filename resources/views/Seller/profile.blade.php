@extends('Layouts.sellerLayout')
@section('content')
        <div class="main w-4/5 p-10">
           <h1 class="text-2xl font-bold mb-5">Profile</h1>
           <div class="seller-image p-5 flex gap-5 shadow relative">
                <div class="settings absolute top-5 right-10">
                    <a href=""><i class="ri-settings-2-line"></i> Settings</a>
                    <a href="{{route('view.seller.logout')}}"><i class="ri-settings-2-line"></i> Log out</a>
                </div>
                <img src="{{ asset('storage/app/uploads/' . (isset($store_banner) ? $store_banner : null)) }}" class="object-cover object-left max-w-[200px]" alt="">
                <div>
                    <div class="form-resetname">
                        <h1 class="mt-3 font-bold text-2xl">{{$store_name}}</h1>                                        
                    </div>
                    <div class="form-resetname">
                        <h1 class="mt-3">Total Products : 12</h1>                                        
                    </div>
                    <div class="form-resetname">
                        <h1 class="mt-3">Total Sales : 12</h1>                                        
                    </div>
                    <div class="form-resetname">                    
                        <h1 class="mt-3">Seller Location : {{$store_address}}</h1>                                        
                    </div>
                    <div class="form-resetname">                    
                        <h1 class="mt-3">Status : Old</h1>                                        
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection
    