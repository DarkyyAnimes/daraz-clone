@extends('Layouts.productLayout')
@section('content')
<div class="container mx-auto">
    <div class="breadcrumb">
      <ul class="text-sm flex my-3">
        <li class="pr-4  text-blue-500">Home </li>       
        <li class="pr-4  ">/ </li>       
        @if (isset($category_info["parent_category"]))           
          <li class="pr-4  text-blue-500">{{$category_info["parent_category"]}}</li>       
          <li class="pr-4  ">/ </li>       
          @endif
        <li class="pr-4  text-blue-500">{{$category_info["current_category"]}}</li>       
      </ul>
    </div>
    <div class="grid md:grid-cols-3 relative rounded">
      <div class="bg-white w-full  col-span-2">
        <div class="grid md:grid-cols-5 gap-5 p-5">
          <div class=" p-0 col-span-2">
            <div class="gallary">
              <div class="image-head">
                <img class="w-full main-image" id="main-image"
                  src="{{$productBanner}}" alt="">
              </div>
              <div
                class="image-details shadow-lg hello  bg-black overflow-hidden col-span-3 top-5 ml-5 right-0 w-[70%] h-[500px] absolute"
                id="b-im">
                <div class="relative  ">
                  <img class="absolute min-w-[1000px] top-0 " id="big-image"
                    src="https://static-01.daraz.com.np/p/e7ec9a4f4ab23279d5086ef757bd785b.jpg_750x750.jpg_.webp"
                    alt="">
                </div>
              </div>
              <div class="image-footer">
                <div class="swiper yourSwiper mt-5">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide :hover-border down-image border-oranger-700">
                      <img src="https://static-01.daraz.com.np/p/bbae9fe0dc6f2af842854996ea35ebef.jpg_100x100.jpg_.webp"
                        alt="">
                    </div>
                    <div class="swiper-slide down-image">
                      <img src="https://static-01.daraz.com.np/p/3e244d2e5a405463c7a5317266c46dd2.jpg_100x100.jpg_.webp"
                        alt="">
                    </div>
                    <div class="swiper-slide down-image">
                      <img src="https://static-01.daraz.com.np/p/b06a5d9f1fecb99bb9d0d1f461e20943.jpg_100x100.jpg_.webp"
                        alt="">
                    </div>
                    <div class="swiper-slide down-image">
                      <img src="https://static-01.daraz.com.np/p/e7ec9a4f4ab23279d5086ef757bd785b.jpg_100x100.jpg_.webp"
                        alt="">
                    </div>
                    <div class="swiper-slide down-image">
                      <img src="https://static-01.daraz.com.np/p/fe01f4f31c39b6e9682b8dd3e436c921.jpg_100x100.jpg_.webp"
                        alt="">
                    </div>

                  </div>
                  <div class="swiper-button-next okay-btn"></div>
                  <div class="swiper-button-prev okay-btn"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full col-span-3">
            <h2 class="text-xl">{{$productName}}
            </h2>
            <div>
              <span class="text-sm mt-20">Brand: <a href="" class="text-blue-500">No Brand</a> | <a  class="text-blue-500" href="">More Cooling & Heating from No Brand</a></span>
            </div>
            <hr class="my-5">
            <div class="price">
                <h2 class="text-4xl text-orange-600">Rs. {{$productSellingPrice}}</h2>
            </div>
            <div class="quantity flex mt-5 items-center">
              <div class="minus px-4 py-2 bg-gray-200" id="quantity_minus">
                -
              </div>
              <div class="minus px-4 py-2 bg-gray-100" id="quantity_value">
                0
              </div>
              <div class="minus px-4 py-2 bg-gray-200" id="quantity_add">
                +
              </div>
            </div>
            
            <div class="buttons flex gap-2 justify-between mt-10">
                <a href=""><button class="bg-blue-400 py-3 px-[65px] text-white">Buy now</button></a>                
                <a href="#" data-id="<?php echo $product->id ?>" id="addToCartLink"><button class="bg-orange-600 py-3 px-[65px] text-white">Add To Cart</button></a>
            </div>

            <div class="message">
              @if (session('product_message'))
              <p class="py-1 rounded my-1 px-10 bg-green-200">
                  {{session('product_message')}}
                </p>
                @endif
            </div>
          </div>
        </div>        
      </div>
      <div class="bg-[#f9f9f9] w-full p-5 col-span-1">
        <div class="delivery ">
            <p class="text-gray-500 text-sm">Delivery</p>
            <div class="delivery-location items-center gap-2 flex">
              <div class="location-icon">
                <i class="ri-map-pin-line text-[32px]"></i>
              </div>
              <div class="location">
                <p class="px-1 font-thin text-[12px]">{{$seller->store_address}}</p>
              </div>
              <div class="location-change">
                <p class="text-blue-400 text-lg">change</p>
              </div>
            </div>
          </div>          
          <hr class="my-1">
          <div class="delivery ">            
            <div class="delivery-location items-center gap-2 flex">
              <div class="location-icon">
                <i class="ri-truck-line text-[32px]"></i>
              </div>
              <div class="location">
                <p class="px-1 font-thin text-[12px]"><b class="font-bold">Standard Delivery </b> <a href="" id="date_product" >26 Feb - 27 Feb</a> <span class="text-gray-400">2 - 3 day(s)
                </span></p>
              </div>
              <div class="location-change">
                <p class="text-blue-400 text-lg">change</p>
              </div>
            </div>
          </div>          
          <hr class="my-1">
          <div class="delivery ">            
            <div class="delivery-location items-center gap-2 flex">
              <div class="location-icon">
                <i class="ri-cash-line text-[32px]"></i>
              </div>
              <div class="location">
                <p class="px-1 font-thin text-[12px]">                 
                  Cash on Delivery</p>
              </div>              
            </div>
          </div>          
        <div class="delivery mt-2">
            <p class="text-gray-500 text-sm">Services</p>
            <div class="delivery-location items-center gap-2 flex">
              <div class="location-icon">
                <i class="ri-calendar-schedule-line text-[32px]"></i>
              </div>
              <div class="location">
                <p class="px-1 font-thin text-[12px]">14 days free & easy return</p>
                <p class="px-1 text-gray-400 font-thin text-[12px]">Change of mind is not applicable
                </p>
              </div>              
            </div>
          </div>          
          <hr class="my-1">
          <div class="delivery ">            
            <div class="delivery-location items-center gap-2 flex">
              <div class="location-icon">
                <i class="ri-shield-line text-[32px]"></i>
              </div>
              <div class="location">
                <p class="px-1 font-thin text-[12px]">
                  @if ($productWarrenty == 'yes')
                    Warrenty Available                                        
                  @else
                    Warrenty Not Available                                        
                  @endif
                </span></p>
              </div>              
            </div>
          </div>                    
        <div class="delivery mt-2">
            <p class="text-gray-500 text-sm">Sold by</p>
            <div class="delivery-location items-center gap-2 flex mt-2">              
              <div class="location">
                <p class="px-1 font-thin text-[14px]">{{$seller->store_name}}</p>                
                </p>
              </div>              
            </div>
            <div class="delivery-location items-center justify-center gap-2 flex mt-2">              
              <div class="location">
                <p class="px-1 font-thin text-blue-500 text-[14px]"><a href="{{route('store', ['id'=>$seller->id])}}">Visit Store</a></p>                                
              </div>              
            </div>
          </div>                                                
      </div>
    </div>
  </div>
  <div class="container mx-auto  my-10 ">
      <div class="grid grid-cols-10  gap-2">
          <div class="col-span-8  bg-white p-5">
            <h1 class="text-xl">Reviews</h1>
            <form action="" method="post">
                <textarea name="" placeholder="Write Comment..." class="border-2 p-2 my-2 w-full border-green" id="" cols="30" rows="10"></textarea>
                <button type="submit" class="bg-orange-600 float-right py-2 px-5 text-white rounded mb-10">Post</button>
            </form>

        <div class="mt-2 mb-5 flex justify-between mt-20">                    
            <h1 >Total Comments : 10</h1>
              <select name="" id="">
                <option value="">Relevent</option>
                <option value="">Recent</option>
              </select>                      
        </div>
       <x-user-comment />
      
      </div>
      <div class="col-span-2 bg-[#f9f9f9] p-5">
        <h1 class="text-xl ">Releted Products</h1>
         
        
      </div>
      </div>
    </div>
  </div>

@endsection
@push('scripts')
  <script>    
    function quantity() {
        let minus = document.getElementById('quantity_minus');
        let add = document.getElementById('quantity_add');
        let value = document.getElementById('quantity_value');
        let okay = parseInt(value.innerText.trim());

        minus.addEventListener('click', () => {
            if (okay > 0) {
                okay--;
                value.innerText = okay;
                updateAddToCartLink(okay);
            }
        });

        add.addEventListener('click', () => {
            okay++;
            value.innerText = okay;
            updateAddToCartLink(okay);
        });
    }

    function updateAddToCartLink(quantity) {
        var productId = {{ $product->id }}; // Assuming you're using PHP to get the product ID
        var baseUrl = "{{ url('/') }}";
        var link = document.getElementById('addToCartLink');
        link.href = `${baseUrl}/add-to-cart/${productId}?number_of_product=${quantity}`;
    }


    // Call the quantity function to initialize it
    quantity();
  </script>
@endpush
