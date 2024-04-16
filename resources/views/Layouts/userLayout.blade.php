<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Daraz : Online Shopping platform</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    @include('Partials.header')
    <div class="container mx-auto">
        <div class="grid item   -center grid-cols-4">
            <div class="col-span-1">
                <div class="categories">
                    @yield('menus')
                </div>
            </div>
            <div class="col-span-3 mt-5">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @yield('slider-banner')
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>   
    <div class="container mx-auto mt-1 pl-5">
        <div class="">
            <div class="flex justify-between cart-items">
                
                @yield('martcart')
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-1 pl-5">
        <div class="mt-8">
            <h1 class="text-xl">Flash Sale</h1>
        </div>
        <div class="mt-4 bg-white border-b border-gray-300 p-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-20">
                    <h5 class="text-medium text-orange-600">On Sale Now</h5>
                    <div class="flex justify-between items-center gap-5 ">
                        <h6>Ending in : </h6>
                        <div class="time flex items-center">
                            <p class="bg-orange-600 p-2 text-white">08</p>
                            <p>&nbsp;:</p>
                            <p class="bg-orange-600 p-2 text-white ml-1">32</p>
                            <p>&nbsp;:</p>
                            <p class="bg-orange-600 p-2 text-white ml-1">04</p>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="shop-more border-outline text-orange-600"> Shop More </button>
                </div>
            </div>
        </div>
        <div class="bg-white pb-8 border-b border-gray-300 p-2">
            <div class="grid gap-2 grid-cols-6">
                
               {{-- Item --}}
               @yield('productitem')

            </div>
        </div>
    </div>
    <div class="container mx-auto mt-1 pl-5">
        <div class="mt-8 mb-4">
            <h1 class="text-xl">Daraz Mall</h1>
        </div>
        <div class="grid gap-2 grid-cols-6">
           
            {{-- Mall Cart --}}
            @yield('mallcart')
           
        </div>
    </div>
    <div class="container mx-auto mt-1 pl-5">
        <div class="mt-8 mb-4">
            <h1 class="text-xl">Categories</h1>
        </div>
        <div class="grid  grid-cols-8">
            
            {{-- Category --}}
            @yield('categorysecond')

        </div>
    </div>
    <div class="container mx-auto mt-1 pl-5">
        <div class="mt-8 mb-4">
            <h1 class="text-xl">Just For You</h1>
        </div>
        <div class="grid gap-2 grid-cols-6">
            
            {{-- Item Second Products --}}
            @yield('Products')
            
        </div>        
    </div>
    <div class="container mx-auto grid place-items-center">
        <button class="px-20 py-4 mt-10 border border-orange-400 text-orange-600 font-bold">Load More</button>
    </div>
    <div class="">

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('/public/js/script.js') }}"></script>
</body>

</html>