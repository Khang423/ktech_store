<div class="leftside-menu">
    <a href="{{ route('admin.dashboard') }}" class="logo logo-light ">
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
                <a href="{{ route('admin.products.index') }}" class="side-nav-link">
                    <i class="uil-desktop"></i>
                    <span>
                        Sản phẩm
                    </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.categoryProducts.index') }}" class="side-nav-link">
                    <i class="uil uil-hdd"></i>
                    <span>
                        Loại sản phẩm
                    </span>
                </a>
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
                <a href="{{ route('admin.inventories.index') }}" class="side-nav-link">
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
            <li class="side-nav-item">
                <a href="{{ route('admin.tags.index') }}" class="side-nav-link">
                    <i class="uil uil-pricetag-alt"></i>
                    <span>
                        Từ khoá tìm kiếm
                    </span>
                </a>
            </li>
            <li class="side-nav-title">
                Hệ thống
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.members.index') }}" class="side-nav-link">
                    <i class="uil uil-users-alt"></i>
                    <span>
                        Tài khoản
                    </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.roles.index') }}" class="side-nav-link">
                    <i class="uil uil-shield"></i>
                    <span>
                        Vai trò
                    </span>
                </a>
            </li>
            <li class="side-nav-title">
            </li>
            <li class="side-nav-title">
            </li>
        </ul>
    </div>
</div>
