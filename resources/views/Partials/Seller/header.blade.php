<div class="logo text-center py-10 px-5">
    <img width="120"
        src="https://icms-image.slatic.net/images/ims-web/e6ac6883-1158-4663-bda4-df5a1aa066e5.png" alt="">
</div>
<ul>
    <li class="py-2 px-10 bg-orange-500 rounded text-xl shadow m-2"><a href="{{route('view.seller.dashboard')}}">Dashboard</a></li>
    <div class="relative w-full">
        <!-- Dropdown Trigger -->
        <button type="button"
            class="py-2 w-[95%] text-left  dropdown-btn px-10 bg-orange-500 rounded text-xl shadow m-2">
            Products
        </button>

        <!-- Dropdown Content -->
        <ul class="absolute hidden bg-white dropdown-menu shadow-md rounded mt-2 right-0 w-36">
            <!-- Dropdown Items -->
            <li class="hover:bg-gray-100">
                <a href="{{route('view.seller.allproducts')}}" class="block text-black py-2 px-4">See All</a>
            </li>
            <li class="hover:bg-gray-100">
                <a href="{{route('view.seller.addproduct')}}" class="block text-black py-2 px-4">Add +</a>
            </li>
        </ul>
    </div>

    <li class="py-2 px-10 bg-orange-500 rounded text-xl shadow m-2"><a href="{{route('view.seller.profile')}}">Profile</a></li>    
    <li class="py-2 px-10 bg-orange-500 rounded text-xl shadow mx-2 my-4"><a href="{{route('view.seller.pending')}}">Pending Order</a></li>    
    <li class="py-2 px-10 bg-orange-500 rounded text-xl shadow mx-2 my-4"><a href="{{route('view.seller.complete')}}">Completed Order</a></li>    
</ul>