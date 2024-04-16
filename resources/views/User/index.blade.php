@extends('Layouts.userLayout')
@section('menus')
<ul class="py-5 categories-items">
    <?php
        $count= 0;
    ?>
    @foreach ($menus as $menu)        
    @if ($count < 12)
        
    <li><a href="{{route("category", ['id'=>$menu["parent_category"]])}}">{{$menu["parent_category"]->category_name}}</a>
        @if ($menu['child_categories'])
        <ul>
            @foreach ($menu['child_categories'] as $child_menu)                    
            <li><a href="{{route("category", ['id'=>$child_menu->id])}}">{{$child_menu->category_name}}</a></li>           
            @endforeach
        </ul>                
        @endif
    </li>    
    @endif
    <?php
    $count++;  ?>
    @endforeach
</ul>
@endsection

@section('slider-banner')
    @foreach ($sliders as $slider)    
    <div class="swiper-slide">
        <img src="{{$slider->slide_image_path}}"
            alt="">
    </div>
    @endforeach
@endsection

@section('martcart')
<?php $count = 0?>
    @foreach ($featured as $featuredItem)        
        @if ($count < 11)           
            <x-category-item name="{{$featuredItem->store_name}}" banner="{{ $featuredItem->store_logo ? $featuredItem->store_logo : asset('/storage/app/uploads/' . $featuredItem->store_image_path) }}" />
        @endif
        <?php $count++?>
    @endforeach    
@endsection

@section('productitem')   
<?php $count = 0?>
    @foreach ($sale as $product)        
    @if ($count < 6)          
        <a href="{{ route('product', ['id' => $product->id]) }}">          
            <x-product-item title="{{ $product->product_name }}" price="{{ $product->product_original_price }}" banner="{{ $product->product_banner }}" orignalprice="{{ $product->product_selling_price }}"  />        
        </a>            
    @endif
            <?php $count++?>
    @endforeach
@endsection

@section('mallcart')   
    <?php $count = 0 ?>
    @foreach ($sellers as $seller)
        @if ($count < 6)        
            <x-mall-cart logo="{{$seller->store_logo}}" banner="{{$seller->store_image_path}}" name="{{$seller->store_name}}" />
        @endif
        <?php $count++ ?>
    @endforeach    
@endsection

@section('categorysecond')  
    <?php $count = 0 ?>
    @foreach ($categories as $category)
        @if ($count < 16 )    
            <a href="{{ route('category', ['id' => $category->id]) }}">
                <div class="category-item">
                    <div class="category-image">
                        <img class="aspect-square object-cover rounded " src="{{ $category->category_image }}" alt="" />
                    </div>
                    <div class="category-body">
                        <h6 class="text-medium">{{ $category->category_name }}</h6>
                    </div>
                </div>
            </a>
            <?php $count++ ?>
        @endif
    @endforeach    
@endsection

@section('Products')
    @forelse ($products as $product)    
        <a href="{{ route('product', ['id' => $product->id]) }}">
            <x-item-cart title="{{ $product->product_name }}" price="{{ $product->product_original_price }}" banner="{{ $product->product_banner }}" orignalprice="{{ $product->product_selling_price }}" />  
        </a>
    @empty
        <p>No products found.</p>
    @endforelse
@endsection
