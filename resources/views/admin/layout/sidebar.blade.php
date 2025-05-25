<div class="leftside-menu">
    <a href="{{ env('APP_URL') }}" class="logo logo-light ">
        <span class="logo-lg mt-3">
            <img src="{{ asset('asset/admin/systemImage/KtechLogo.png') }}" alt="Hytertech"
                style="width: 100px;height: 100px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('asset/admin/systemImage/KtechLogo.png') }}" alt="Hytertech"
                style="height:30px;width:30px">
        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <ul class="side-nav">
            <li class="side-nav-title">
                Điều khiển
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class=" uil-chart-line"></i>
                    <span class="badge bg-success float-end">5</span>
                    <span>
                        Bảng điều khiển
                    </span>
                </a>
            </li>

            <li class="side-nav-title">
                Quản lý chức năng
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.banners.index') }}" class="side-nav-link">
                    <i class="uil uil-presentation-play"> </i>
                    <span>
                        Trình chiếu slide
                    </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a class="side-nav-link collapsed" data-bs-toggle="collapse" href="#sidebarDevice" aria-expanded="false"
                    aria-controls="sidebarDevice">
                    <i class="uil-desktop"></i>
                    <span>
                        Sản phẩm
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDevice" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.products.index') }}">
                                Danh sách sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categoryProducts.index') }}">
                                Danh mục sản phẩm
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.suppliers.index') }}" class="side-nav-link">
                    <i class="uil-truck"> </i>
                    <span>
                        Nhà cung cấp
                    </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.brands.index') }}" class="side-nav-link">
                    <i class="uil-circuit"></i>
                    <span>
                        Thương hiệu
                    </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="\" class="side-nav-link">
                    <i class=" uil-bill"></i>
                    <span>
                        Hoá đơn
                    </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="\" class="side-nav-link">
                    <i class=" uil-home-alt"></i>
                    <span>
                        Kho hàng
                    </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="\" class="side-nav-link">
                    <i class=" uil-usd-circle"></i>
                    <span>
                        Giảm giá
                    </span>
                </a>
            </li>
            <li class="side-nav-title">
                Hệ thống
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.members.index') }}" class="side-nav-link">
                    <i class=" uil uil-users-alt"></i>
                    <span>
                       Tài khoản
                    </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a class="side-nav-link collapsed" data-bs-toggle="collapse" href="#sidebarRoles" aria-expanded="false"
                    aria-controls="sidebarDevice">
                    <i class="uil-label"></i>
                    <span>
                        Vai trò
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarRoles" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.roles.index') }}">
                                Danh sách
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Đặt quyền
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-title">
            </li>
            <li class="side-nav-title">
            </li>
        </ul>
    </div>
</div>
