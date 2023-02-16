  @extends('master')
  @section('content')
      <!--start content-->
      <main class="page-content">

          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
              <div class="col">
                  <div class="card radius-10">
                      <div class="card-body">
                          <div class="d-flex align-items-center">
                              <div>
                                  <p class="mb-0 text-secondary">Tổng đơn hàng</p>
                                  <h4 class="my-1">{{ $totalOrders }}</h4>
                                  <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i>tăng 5% từ tuần
                                      trước</p>
                              </div>
                              <div class="widget-icon-large bg-gradient-purple text-white ms-auto"><i
                                      class="bi bi-basket2-fill"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card radius-10">
                      <div class="card-body">
                          <div class="d-flex align-items-center">
                              <div>
                                  <p class="mb-0 text-secondary">Doanh thu</p>

                                  <h4 class="my-1">{{ number_format($totalPrice) }}Đ</h4>
                                  <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i>Tăng 4.6 từ tuần
                                      trước</p>
                              </div>
                              <div class="widget-icon-large bg-gradient-success text-white ms-auto"><i
                                      class="bi bi-currency-exchange"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card radius-10">
                      <div class="card-body">
                          <div class="d-flex align-items-center">
                              <div>
                                  <p class="mb-0 text-secondary">Khách hàng</p>
                                  <h4 class="my-1">{{ $totalCustomer }}</h4>
                                  <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> Tăng 1 từ tuần
                                      trước</p>
                              </div>
                              <div class="widget-icon-large bg-gradient-danger text-white ms-auto"><i
                                      class="bi bi-people-fill"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col">
                  <div class="card radius-10">
                      <div class="card-body">
                          <div class="d-flex align-items-center">
                              <div>
                                  <p class="mb-0 text-secondary">Nhân viên</p>
                                  <h4 class="my-1">{{ $totalUsers }}</h4>
                                  <p class="mb-0 font-13 text-success"><i class="bi bi-caret-up-fill"></i> Tăng 1 từ tuần
                                      trước</p>
                              </div>
                              <div class="widget-icon-large bg-gradient-info text-white ms-auto"><i
                                      class="bi bi-bar-chart-line-fill"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!--end row-->
          <div class="row">
              <div class="col-12 col-lg-8 col-xl-8 d-flex">
                  <div class="card radius-10 w-100">
                      <div class="card-body">
                          <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
                              <div class="col">
                                  <h5 class="mb-0">Doanh số bán hàng</h5>
                              </div>
                              <div class="col">
                                  <div class="d-flex align-items-center justify-content-sm-end gap-3 cursor-pointer">
                                      <div class="font-13"><i class="bi bi-circle-fill text-primary"></i><span
                                              class="ms-2">Bán</span></div>
                                      <div class="font-13"><i class="bi bi-circle-fill text-success"></i><span
                                              class="ms-2">Đơn hàng</span></div>
                                  </div>
                              </div>
                          </div>
                          <div id="chart1"></div>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-lg-4 col-xl-4 d-flex">
                  <div class="card radius-10 w-100">
                      <div class="card-header bg-transparent">
                          <div class="row g-3 align-items-center">
                              <div class="col">
                                  <h5 class="mb-0">Số liệu thống kê</h5>
                              </div>
                              <div class="col">
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <div id="chart2"></div>
                      </div>
                      <ul class="list-group list-group-flush mb-0">
                          <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Đơn
                              đặt hàng<span class="badge bg-primary badge-pill">25%</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Hoàn
                              thành<span class="badge bg-orange badge-pill">65%</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Chưa
                              giải quyết<span class="badge bg-success badge-pill">10%</span>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          
          <div class="card radius-10">
              <div class="card-header bg-transparent">
                  <div class="row g-3 align-items-center">
                      <div class="col">
                          <h5 class="mb-0">Top sản phẩm bán chạy</h5>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table align-middle mb-0">
                          <thead class="table-light">
                              <tr>
                                  <th>Ảnh</th>
                                  <th>Tên sản phẩm</th>
                                  <th>Giá</th>
                                  <th>Đã bán</th>
                                  <th>Doanh thu</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($topproduct as $product)
                              <tr>
                                <td> <img src="{{ asset('storage/images/' . $product->image) }}"style="width:100px;"></td>
                                  <td>
                                      <div class="d-flex align-items-center gap-3">

                                          <div class="product-info">
                                              <h6 class="product-name mb-1">{{$product->name}}</h6>
                                          </div>
                                      </div>
                                  </td>
                                  <td>{{$product->price}}</td>
                                  <td>{{$product->total_Product }}</td>
                                  <td>{{number_format($product->total_Price) }}Đ</td>

                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

          <div class="card radius-10">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h5 class="mb-0">Sản phẩm mới</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Thể loại</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($productnew as $products)
                            <tr>
                              <td> <img src="{{ asset('storage/images/' . $products->image) }}"style="width:100px;"></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="product-info">
                                            <h6 class="product-name mb-1">{{$products->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{number_format($products->price)}}Đ </td>
                                <td>{{$products->category->name }}</td>
                                <td>{{$products->quantity}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


      </main>
      <!--end page main-->
  @endsection
