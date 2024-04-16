<div class="item-card bg-white">
    <img src="{{$banner}}"
        alt="">
    <div class="card-body p-2">
        <h5 class="title">{{$title}}</h5>
        <h6 class="price">Rs. {{$orignalprice}}</h6>
        @if ($price > $orignalprice)
        <div class="discount"><span class="o-price line-through text-gray-400">Rs. {{$price}} </span><span
                class="percentage"> 
                -{{ 100 - intval(($orignalprice * 100 )/ $price)}}%
                </span></div>@endif 
        <div class="reviews flex text-gray-400">
            <span><i class="ri-star-fill text-orange-600"></i></span>
            <span><i class="ri-star-fill text-orange-600"></i></span>
            <span><i class="ri-star-fill text-orange-600"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
        </div>
    </div>
</div>