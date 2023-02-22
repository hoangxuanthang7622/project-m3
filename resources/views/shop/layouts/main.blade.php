@extends('shop.mastershop')
@section('contentShop')
<section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-02.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                {{-- <div class="hero-content">
                    <h6>Thời trang</h6>
                    <h2>Bộ sưu tập</h2>
                    <a href="{{route('productall')}}" class="btn essence-btn">Xem bộ sưu tập</a>
                </div> --}}
            </div>
        </div>
    </div>
</section>
{{-- <div class="cta-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/bg-5.jpg);">
                    <div class="h-100 d-flex align-items-center justify-content-end">
                        <div class="cta--text">
                            <h6>-10%</h6>
                            <h2>Giảm giá sốc</h2>
                            <a href="{{route('productall')}}" class="btn essence-btn" class="btn essence-btn">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Sản phẩm</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    @foreach ($products as $product)
                    <!-- Single Product -->
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{ asset('storage/images/' . $product->image) }}">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="{{ asset('storage/images/' . $product->image) }}">
                            <!-- Favourite -->
                            <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <span>topshop</span>
                            <a href="{{route('shop.show',$product->id)}}">
                                <h6>{{$product->name}}</h6>
                            </a>
                            <p class="product-price">{{number_format($product->price)}}Đ</p>

                            <!-- Hover Content -->
                            <div class="hover-content">
                                <!-- Add to Cart -->
                                <div class="add-to-cart-btn">
                                    <a href="{{route('shop.addToCart', $product->id)}}" id="{{$product->id}}" class="btn essence-btn">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
