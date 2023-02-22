<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{{route('shop.index')}}"><img src="{{asset('shop/img/core-img/c.png')}}" style="width:130px" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>

                        <li><a href="#">Shop</a>
                            <ul class="dropdown">
                                <li><a href="{{route('shop.index')}}">Trang chủ</a></li>
                                <li><a href="{{route('productall')}}">Sản phẩm</a></li>
                                <li><a href="{{route('shop.checkout')}}">Thanh toán</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Sản phẩm</a>
                            <div class="megamenu">
                            @foreach ($items as $item)
                                <ul class="single-mega cn-col-4">
                                    <li style="color: blue" class="title">{{$item->name}}<strong></li>
                                        {{-- {{ dd($items->product)}}; --}}
                                        @foreach ($item->products as $product)

                                        <li><a href="{{route('shop.show',$product->id)}}">{{$product->name}}</a></li>
                                        @endforeach
                                </ul>
                                @endforeach

                            </div>
                        </li>
                        {{-- <li><a href="contact.html">Contact</a></li> --}}
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form>
                    <input type="search" name="key1" id="headerSearch" placeholder="Nhập để tìm kiếm">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
            <div class="favourite-area">
                <a href="#"><img src="{{asset('shop/img/core-img/heart.svg')}}" alt=""></a>
            </div>
            <!-- User Login Info -->
            <div class="user-login-info">
                <a href="#"><img src="{{asset('shop/img/core-img/user.svg')}}" alt=""></a>
            </div>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="{{asset('shop/img/core-img/bag.svg')}}" alt=""> <span>3</span></a>
            </div>
        </div>

    </div>
</header>