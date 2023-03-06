@extends('shop.mastershop')
@section('contentShop')


    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Địa chỉ giao hàng</h5>
                        </div>

                        <form action="{{route('shop.order')}}" method="post">
                            @csrf
                            <div class="row">
                                @if (isset(Auth()->guard('customers')->user()->name))
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">Họ và tên<span>*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth()->guard('customers')->user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Email<span>*</span></label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ Auth()->guard('customers')->user()->email }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="company">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ Auth()->guard('customers')->user()->phone }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="street_address">Địa chỉ <span>*</span></label>
                                    <input type="text" class="form-control mb-3" name="address"
                                        value="{{ Auth()->guard('customers')->user()->address }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Đặt
                                hàng</button>
                    </div>
                    @else
                    <div class="col-12 mb-3">
                        <label for="street_address">Vui lòng đăng nhập trước khi thanh toán
                            nhé <span>*</span></label>
                            <a href="{{ route('shop.login') }}"
                            class="btn btn-primary">Đăng Nhập</a>
                    </div>
                @endif
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Đơn hàng của bạn</h5>
                        </div>
                        @php
                        $totalAll = 0;
                    @endphp
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php
                                    $total = $details['price'] * $details['quantity'];
                                    $totalAll += $total;

                                @endphp
                                <ul class="order-details-form mb-4">
                                    <li><span>Sản phẩm</span> <span><input type="hidden" value="{{ $id }}" name="product_id[]">{{ $details['nameVi'] ?? '' }}</span></li>
                                    <li><span>Số lượng</span> <span><input type="hidden" value="{{$id}}" name="quantity[]">{{ $details['quantity'] ?? '' }}</span></li>
                                    <li><span>Giá tiền</span> <span><input type="hidden" value="{{ $id }}" name="total[]">{{ number_format($details['price'] ?? '') }}vnd</span></li>

                                    <li><span>Phí ship</span> <span>Free</span></li>
                                    <li><span>Giảm giá</span> <span>10%</span></li>
                                    @php
                                        $tong = $totalAll * (10/100);
                                        $totalAll -= $tong;
                                    @endphp
                                    <li><span>Tổng tiền</span><span>{{ number_format($totalAll) }}vnd</span></li>
                                    <input type="number" value="{{$totalAll}}" name="total" hidden>
                                </ul>


                                @endforeach
                                @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection
