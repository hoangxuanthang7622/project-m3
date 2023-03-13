@extends('shop.mastershop')
@section('contentShop')
<section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
            <img src="{{ asset('storage/images/' . $productdetail->image) }}">
            <img src="{{ asset('storage/images/' . $productdetail->image) }}">
            <img src="{{ asset('storage/images/' . $productdetail->image) }}">
        </div>
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <a href="cart.html">
            <h2>{{$productdetail->name}}</h2>
        </a>
        <p class="product-price"><span class="old-price">{{number_format($productdetail->price + (30/100*$productdetail->price))}}Đ</span>{{number_format($productdetail->price)}}Đ</p>
        <p class="product-desc">{{$productdetail->description}}</p>

        <!-- Form -->
        <form class="cart-form clearfix" method="post">
            <!-- Select Box -->
            <div class="select-box d-flex mt-50 mb-30">
                <select name="select" id="productSize" class="mr-5">
                    <option value="value">Size: XL</option>
                    <option value="value">Size: X</option>
                    <option value="value">Size: M</option>
                    <option value="value">Size: S</option>
                </select>
                <select name="select" id="productColor">
                    <option value="value">Color: Black</option>
                    <option value="value">Color: White</option>
                    <option value="value">Color: Red</option>
                    <option value="value">Color: Purple</option>
                </select>
            </div>
            <!-- Cart & Favourite Box -->
            <div class="cart-fav-box d-flex align-items-center">
                <!-- Cart -->
                {{-- <button type="submit" name="addtocart" value="5" class="btn essence-btn">Thêm vào giỏ hàng</button> --}}
                <a href="{{route('shop.addToCart', $productdetail->id)}}" id="{{$productdetail->id}}" class="btn essence-btn">Thêm vào giỏ hàng</a>

                <!-- Favourite -->
                {{-- <div class="product-favourite ml-4">
                    <a href="#" class="favme fa fa-heart"></a>
                </div> --}}
            </div>
        </form>
    </div>
</section>
@endsection
