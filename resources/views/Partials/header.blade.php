<header class="bg-orange-600 w-100 pb-4">
    <div class="container mx-auto">
        <div class="upper-head  flex justify-between ">
            <ul class="flex gap-5  text-white text-sm">
                <li>
                    <a href="">Become a seller</a>
                </li>
                <li>
                    <a href="">Payments & Recharge</a>
                </li>
                <li>
                    <a href="">Help & Support</a>
                </li>
                <li>
                    <a href="">Daraz Logistics</a>
                </li>
            </ul>
            <div class="cta flex gap-5 hover:bg-orange-600  rounded text-white">
                <div class="flex items-center  cursor-pointer bg-orange-800 justify-between p-1  gap-2">
                    <img width="20"
                        src="https://img.alicdn.com/imgextra/i1/O1CN01Ie2YnK1JmZ1mL3fY5_!!6000000001071-2-tps-60-60.png"
                        alt="">
                    <a href="{{route('order.products')}}" class="save-more-on-app  mr-1">Ordered Products</a>                   
                </div>
                <div class="flex items-center  bg-orange-800 justify-between p-1  gap-2">
                    <img width="20"
                        src="https://img.alicdn.com/imgextra/i1/O1CN01Ie2YnK1JmZ1mL3fY5_!!6000000001071-2-tps-60-60.png"
                        alt="">                   
                    <p class="save-more-on-app  mr-1">Save more in App</p>
                </div>
            </div>
        </div>
        <nav class="flex justify-between items-center">
            <div class="flex gap-5 items-center">
                <div class="logo">
                    <a href="{{url('/')}}">                        
                        <img width="120"src="https://icms-image.slatic.net/images/ims-web/e6ac6883-1158-4663-bda4-df5a1aa066e5.png"alt="">
                    </a>
                </div>
                <div class="search-form relative">
                    <form action="">
                        <input type="search" placeholder="Search in Daraz"
                            class="py-1 px-4 text-sm rounded-xl focus:outline-none" name="search " id="">
                        <button type="submit"
                            class="bg-orange-300 text-orange px-4 rounded absolute top-2 right-2 right"><i
                                class="ri-search-line text-orange"></i></button>
                    </form>
                </div>
            </div>
            @if (Auth::guard('seller')->check())
                    <a href="{{route('view.seller.dashboard')}}" class="py-2 px-5 mt-5 rounded text-white bg-orange-400">Go to Seller's Dashboard</a>
            @endif            
            @if (Auth::guard('admin')->check())
                    <a href="{{route('admin.dashboard')}}" class="py-2 px-5 mt-5 rounded text-white bg-blue-800">Manage Site</a>
            @endif            
            @if (!Auth::check() && !Auth::guard('seller')->check() && !Auth::guard('admin')->check())                
            <div class="login-signup flex gap-5 text-md text-white items-center">
                <div class="flex flex gap-2 text-md text-white items-center">
                    <li><button class="login"><a href="{{route('login')}}"><i class="ri-user-line"></i> Login</a></button></li>
                    <li>|</li>
                    <li><button class="login"><a href="{{route('view.user.register')}}">Sign Up</a></button></li>
                </div>
                <div class="carts relative">
                    <a href="{{route('user.carts')}}">
                        <i class="ri-shopping-cart-2-line text-4xl text-white"></i>
                        
                    </a>
                </div>
            </div>
            @endif
            @if(Auth::check() && !Auth::guard('seller')->check())
            <div class="user_sign cursor-pointer mt-5">
                <div class="user-image flex items-center gap-2">
                    <img src="{{ asset('storage/app/uploads/' . (isset($user_image) ? $user_image : null)) }}" class="w-[40px] h-[40px] object-cover rounded-full" alt="User Image">
                    <div class="flex items-center">
                        <div class="">
                            <p class="text-white  text-md font-bold">Hello, {{ (isset($name) ? $name : null) }}</p>
                            <p class="text-sm text-white m-0 p-0">Orders & Accounts</p>
                        </div>
                        <div class="text-white relative">
                            
                            <ul class=" rounded">
                                <li class="menu"><i class="ri-arrow-down-s-line text-4xl down-icon"></i>
                                    <ul>
                                        <li><a href="" class="flex items-center gap-1">Profile</a></li>                                
                                        <li><a href="{{route('user.logout')}}" class="flex items-center gap-1">Logout <i class="ri-logout-box-r-line"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="carts relative">
                        <a href="{{route('user.carts')}}">
                            <i class="ri-shopping-cart-2-line text-4xl text-white"></i>
                            <div class="number_of_products text-sm">
                                @if(isset($cart))
                                    {{$cart->count()}}
                                @endisset
                            </div>
                        </a>
                    </div>
                </div>                                    
            </div>  
        @endif
        
        </nav>
    </div>
</header>