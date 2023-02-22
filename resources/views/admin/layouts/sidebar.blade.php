      <!--start sidebar -->
      <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
          <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
          </div>
          <div>
            <img src="{{asset('shop/img/core-img/c.png')}}" style="width:130px" alt="">
          </div>
          <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
          </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
          <li>
            <a href="{{route('home')}}">
              <div class="parent-icon"><i class="bi bi-house-door"></i>
              </div>
              <div class="menu-title">Trang chủ</div>
            </a>

          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-list-ul"></i>
              </div>
              <div class="menu-title">Quản lí thể loại</div>
            </a>
            <ul>
              <li> <a href="{{route('category.index')}}"><i class="bi bi-arrow-right-short"></i>Thể loại</a>
              </li>
              <li> <a href="{{route('category.trash')}}"><i class="bi bi-arrow-right-short"></i>Thùng rác</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-grid"></i>
              </div>
              <div class="menu-title">Quản lí sản phẩm</div>
            </a>
            <ul>
              <li> <a href="{{route('product.index')}}"><i class="bi bi-arrow-right-short"></i>Sản phẩm</a>
              </li>
              <li> <a href="{{route('product.trash')}}"><i class="bi bi-arrow-right-short"></i>Thùng rác</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-telephone-inbound"></i>
              </div>
              <div class="menu-title">Quản lí khách hàng</div>
            </a>
            <ul>
              <li> <a href="{{route('customer.index')}}"><i class="bi bi-arrow-right-short"></i>Khách hàng</a>
              </li>

            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-bell"></i>
              </div>
              <div class="menu-title">Quản lí đơn hàng</div>
            </a>
            <ul>
              <li> <a href="{{route('order.index')}}"><i class="bi bi-arrow-right-short"></i>Đơn hàng</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-person-circle"></i>
              </div>
              <div class="menu-title">Quản lí nhân sự</div>
            </a>
            <ul>
              <li> <a href="{{route('user.index')}}"><i class="bi bi-arrow-right-short"></i>Nhân viên</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-share"></i>
              </div>
              <div class="menu-title">Quản lí chức vụ</div>
            </a>
            <ul>
              <li> <a href="{{route('group.index')}}"><i class="bi bi-arrow-right-short"></i>Chức vụ</a>
              </li>
            </ul>
          </li>

        <!--end navigation-->
     </aside>
     <!--end sidebar -->
