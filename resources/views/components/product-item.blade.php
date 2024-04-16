<div class="item-card">
    <img src="{{$banner}}" alt="">
    <div class="card-body">
        <h5 class="title">{{$title}}</h5>
        <h6 class="price">Rs . {{$orignalprice}}</h6>
        <div class="discount"><span class="o-price line-through text-gray-400">Rs. {{$price}}</span><span
                class="percentage"> -{{ 100 - intval($orignalprice * 100 / $price)}}%</span></div>
    </div>
</div>