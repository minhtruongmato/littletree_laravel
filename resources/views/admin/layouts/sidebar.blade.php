 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("public/admin/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview {{(Request::segment(2) == 'introduce' || Request::segment(2) == 'library' || Request::segment(2) == 'image')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Bài viết giới thiệu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(3) == 've-chung-toi')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/ve-chung-toi') }}">Về chúng tôi</a>
            </li>
            <li class="{{(Request::segment(3) == 'tam-nhin-chien-luoc')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/tam-nhin-chien-luoc') }}">Tầm nhìn chiến lược</a>
            </li>
            <li class="{{(Request::segment(3) == 'su-menh')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/su-menh') }}">Sứ mệnh</a>
            </li>
            <li class="{{(Request::segment(3) == 'chung-nhan')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/chung-nhan') }}">Chứng nhận</a>
            </li>
            <li class="{{(Request::segment(3) == 'dieu-khoan')? 'active' : '' }}">
              <a href="{{ url('admin/introduce/dieu-khoan') }}">Điểu khoản</a
                ></li>
            <li class="{{(Request::segment(2) == 'library' || Request::segment(2) == 'image')? 'active' : '' }}">
              <a href="{{ url('admin/library') }}">Thư viện ảnh</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{(Request::segment(2) == 'trademark' || Request::segment(2) == 'category' || Request::segment(2) == 'product' || Request::segment(2) == 'type' || Request::segment(2) == 'kind' || Request::segment(2) == 'origin')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Quản lý sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(2) == 'type')? 'active' : '' }}">
              <a href="{{ url('admin/type') }}">Loại sản phẩm</a>
            </li>
            <li class="{{(Request::segment(2) == 'kind')? 'active' : '' }}">
              <a href="{{ url('admin/kind') }}">Dòng sản phẩm</a>
            </li>
            <li class="{{(Request::segment(2) == 'trademark')? 'active' : '' }}">
              <a href="{{ url('admin/trademark') }}">Thương hiệu</a>
            </li>
            {{--<li class="{{(Request::segment(2) == 'category')? 'active' : '' }}">
              <a href="{{ url('admin/category') }}">Danh mục</a>
            </li>--}}
            <li class="{{(Request::segment(2) == 'product')? 'active' : '' }}">
              <a href="{{ url('admin/product') }}">Sản phẩm</a>
            </li>
            <li class="{{(Request::segment(2) == 'origin')? 'active' : '' }}">
              <a href="{{ url('admin/origin') }}">Xuất xứ</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{(Request::segment(2) == 'order')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Quản lý đơn hàng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(3) == 'pending')? 'active' : '' }}">
              <a href="{{ url('admin/order/pending') }}">Chờ xác nhận</a>
            </li>
            <li class="{{(Request::segment(3) == 'ongoing')? 'active' : '' }}">
              <a href="{{ url('admin/order/ongoing') }}">Đã xác nhận</a>
            </li>
            <li class="{{(Request::segment(3) == 'complete')? 'active' : '' }}">
              <a href="{{ url('admin/order/complete') }}">Đã hoàn thành</a>
            </li>
            <li class="{{(Request::segment(3) == 'cancel')? 'active' : '' }}">
              <a href="{{ url('admin/order/cancel') }}">Đã bỏ qua</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{(Request::segment(2) == 'blog-category' || Request::segment(2) == 'advise' || Request::segment(2) == 'news')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Quản lý bài viết</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(2) == 'blog-category')? 'active' : '' }}">
              <a href="{{ url('admin/blog-category') }}">Danh mục</a>
            </li>
            <li class="{{(Request::segment(2) == 'advise')? 'active' : '' }}">
              <a href="{{ url('admin/advise') }}">Tư vấn</a>
            </li>
            <li class="{{(Request::segment(2) == 'news')? 'active' : '' }}">
              <a href="{{ url('admin/news') }}">Tin tức</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{(Request::segment(2) == 'tasting')? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Quản lý thử rượu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{(Request::segment(2) == 'tasting' && Request::segment(3) == '')? 'active' : '' }}">
              <a href="{{ url('admin/tasting') }}">Chờ xử lý</a>
            </li>
            <li class="{{(Request::segment(3) == 'finish')? 'active' : '' }}">
              <a href="{{ url('admin/tasting/finish') }}">Đã hoàn thành</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{(Request::segment(2) == 'subscribe')? 'active' : '' }}">
          <a href="{{ url('admin/subscribe') }}"><i class="fa fa-link"></i> <span>Subscribe</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
{{--        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>User management</span></a></li>--}}
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>