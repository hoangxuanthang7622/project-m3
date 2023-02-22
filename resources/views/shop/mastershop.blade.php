<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Template</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('shop/img/core-img/favicon.ico') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('shop/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/style.css') }}">

</head>

<body>
    <!-- ##### Header Area Start ##### -->
    @include('shop.layouts.header')
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="{{ asset('shop/img/core-img/bag.svg') }}" alt="">
                <span>3</span></a>
        </div>
        @php
        $total = 0;
        $totalAll = 0;
    @endphp

    @if (session('cart'))
        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
            @foreach (session('cart') as $id => $details)
            @php
            $total = $details['price'] * $details['quantity'];
            $totalAll += $total;
        @endphp
                <div class="single-cart-item">
                    <a href="{{ route('shop.remove11',$id) }}" id="{{ $id }}" class="product-image">
                        <img src="{{ asset('storage/images/' . $details['image']) }}" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <h6>{{$details['nameVi']}}</h6>
                            <h6>{{$details['quantity']}}</h6>

                            <p class="size">{{number_format($details['price'])}}Đ</p>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Đơn hàng </h2>
                <ul class="summary-table">
                    <li><span>Tổng tiền:</span> <span>{{ number_format($totalAll) }}.vnd</span></li>
                    <li><span>Phí vận chuyển:</span> <span>Miễn phí</span></li>
                    <li><span>Giảm giá:</span> <span>-10%</span></li>
                    @php
                    $tong = $totalAll * (30/100);
                    $totalAll -= $tong;
                    @endphp
                    <li><span>Tổng thanh toán:</span> <span>{{ number_format($totalAll) }}.vnd</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout.html" class="btn essence-btn">Thanh toán</a>
                </div>
            </div>
        </div>
        @else
        <tr>
            <td>
                Giỏ hàng của bạn chưa có sản phẩm nào?
            </td>
        </tr>
    @endif
    </div>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Welcome Area Start ##### -->

    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    {{-- <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(shop/img/bg-img/bg-2.jpg);">
                        <div class="catagory-content">
                            <a href="#">Clothing</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(shop/img/bg-img/bg-3.jpg);">
                        <div class="catagory-content">
                            <a href="#">Shoes</a>
                        </div>
                    </div>
                </div>
                <!-- Single Catagory -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(shop/img/bg-img/bg-4.jpg);">
                        <div class="catagory-content">
                            <a href="#">Accessories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    {{-- <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(shop/img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="#" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    @yield('contentShop')
    {{-- @include('shop.layouts.main') --}}


    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('shop/img/core-img/brand1.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('shop/img/core-img/brand2.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('shop/img/core-img/brand3.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('shop/img/core-img/brand4.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('shop/img/core-img/brand5.png') }}" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="{{ asset('shop/img/core-img/brand6.png') }}" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    @include('shop.layouts.footer')
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('shop/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('shop/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('shop/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('shop/js/plugins.js') }}"></script>
    <!-- Classy Nav js -->
    <script src="{{ asset('shop/js/classy-nav.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('shop/js/active.js') }}"></script>

</body>

</html>
