@extends('shop.mastershop')
@section('contentShop')
<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="shop_sidebar_area">

                    <!-- ##### Single Widget ##### -->
                    <div class="widget catagory mb-50">
                        <!-- Widget Title -->
                        <h6 class="widget-title mb-30">Thể Loại</h6>

                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#clothing">
                                    {{-- <a href="#">V</a> --}}

                                    {{-- <ul class="sub-menu collapse show" id="clothing"> --}}
                                        @foreach ($categories as $category)

                                        <li><a href="{{route('detail',$category->id)}}">{{$category->name}}</a></li><hr>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p><span>{{count($products)}} </span>Sản phẩm</p>
                                </div>
                                <!-- Sorting -->
                                {{-- <div class="product-sorting d-flex">
                                    <p>Sort by:</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortByselect">
                                            <option value="value">Highest Rated</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Price: $$ - $</option>
                                            <option value="value">Price: $ - $$</option>
                                        </select>
                                        <input type="submit" class="d-none" value="">
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="{{ asset('storage/images/' . $product->image) }}">
                                    <!-- Hover Thumb -->
                                    {{-- <img class="hover-img" src="img/product-img/product-2.jpg" alt=""> --}}

                                    <!-- Product Badge -->
                                    <div class="product-badge offer-badge">
                                        <span>-30%</span>
                                    </div>
                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <a href="single-product-details.html">
                                        <h6>{{$product->name}}</h6>
                                    </a>
                                    <p class="product-price"><span class="old-price">{{number_format($product->price + (30/100*$product->price))}}Đ</span>{{number_format($product->price)}}Đ</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="{{route('shop.addToCart', $product->id)}}" id="{{$product->id}}" class="btn essence-btn">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Single Product -->



                    </div>
                </div>
                <!-- Pagination -->
                <div class="col-6">
                    <div class="pagination float-right">
                    {{-- {{ $products->appends(request()->query()) }} --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
@endsection
