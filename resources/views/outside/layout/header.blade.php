<div class="header">
    <div class="container justify-content-center">
        {{-- desktop --}}
        <div class="content">
            <div class="row">
                <div class="col-2">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset('asset/outside/logo.svg') }}" alt="Logo Ktech">
                        </a>
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-2">
                            <div class="category-product" id="button-category-product">
                                <div class="content d-flex">
                                    <div class="menu toggle-desktop-menu">
                                        <img src="{{ asset('asset/outside/icon/menu.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="search-bar">
                                <div class="content">
                                    <input type="text" name="keyword" class="input-search-bar"
                                        placeholder="Nhập tên điện thoại,laptop, phụ kiền... cần tìm">
                                    <div class="circle-icon">
                                        <i class="uil-search" id="icon-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="profile d-flex">
                        <div class="user">
                            @auth('customers')
                                @php
                                    $account_name = Auth::guard('customers')->user()->name ?? '';
                                    $last_name = collect(explode(' ', $account_name))->last();
                                @endphp
                                <div class="circle-user" onclick="goToPageProfile()">
                                    <div class="thumbnail">
                                        <img src="{{ asset('asset/outside/icon/user.png') }}" alt="Icon user">
                                    </div>
                                    <span class="account-name">Hi , {{ $last_name }}</span>
                                </div>
                            @endauth
                            @guest('customers')
                                <div class="circle-user" id="btn-user">
                                    <div class="thumbnail">
                                        <img src="{{ asset('asset/outside/icon/user.png') }}" alt="Icon user">
                                    </div>
                                    <span class="account-name">Đăng Nhập</span>
                                </div>
                            @endguest
                        </div>
                        @auth('customers')
                            <div class="cart">
                                <div class="content">
                                    <div class="border-cart btn-cart d-flex">
                                        <div class="icon-cart">
                                            <img src="{{ asset('asset/outside/icon/cart.png') }}" alt="Icon cart">
                                        </div>
                                        <div class="circle-quantity-item-cart">
                                            {{ checkCountCart(Auth::guard('customers')->user()->id) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        @guest('customers')
                            <div class="cart">
                                <div class="content">
                                    <div class="border-cart btn-cart d-flex">
                                        <div class="icon-cart">
                                            <img src="{{ asset('asset/outside/icon/cart.png') }}" alt="Icon cart">
                                        </div>
                                        <div class="circle-quantity-item-cart">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div class="desktop-menu d-none">
            <div class="sidebar">
                <div class="item">

                    <div class="title" data-name="laptop">
                        <i class="uil uil-monitor fs-2"></i>
                        <a
                            href="{{ route('home.showProduct', [
                                'data' => 'laptop',
                            ]) }}">
                            <span class="text-dark">Laptop</span>
                        </a>
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-right"></i>
                    </div>
                </div>
                <div class="item">
                    <div class="title" data-name="phone">
                        <i class="uil uil-mobile-android fs-2"></i>
                        <a
                            href="{{ route('home.showProduct', [
                                'data' => 'dien-thoai',
                            ]) }}">
                            <span class="text-dark">Điện thoại</span>
                        </a>
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-right"></i>
                    </div>
                </div>
                <div class="item">
                    <div class="title" data-name="keyboard">
                        <i class="uil uil-keyboard-alt fs-2"></i>
                        <span>Phím Cơ</span>
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-right"></i>
                    </div>
                </div>
                <div class="item">
                    <div class="title" data-name="mouse">
                        <i class="uil uil-mouse-alt fs-2"></i>
                        <span>Chuột</span>
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-right"></i>
                    </div>
                </div>
                <div class="item">
                    <div class="title" data-name="headphone">
                        <i class="uil uil-headphones-alt fs-2"></i>
                        <span>Tai nghe</span>
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-right"></i>
                    </div>
                </div>
            </div>
            <div class="overlay">
                <div class="sidebar-tab d-none" id="sidebar-tab">
                    <div class="content tab-laptop d-none">
                        @foreach (getDataBrandLaptop() as $i)
                            <div class="item">
                                <a href="">
                                    <div class="title">
                                        {{ $i->name }}
                                    </div>
                                </a>
                                <div class="content-child">
                                    @foreach ($i->modelSeries as $model)
                                        <a
                                            href="{{ route('home.showProduct', [
                                                'data' => $model->name,
                                            ]) }}">
                                            <div class="item">
                                                {{ $model->name }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="content tab-phone d-none">
                        @foreach (getDataBrandLaptop() as $i)
                            <div class="item">
                                <a href="">
                                    <div class="title">
                                        {{ $i->name }}phone
                                    </div>
                                </a>
                                <div class="content-child">
                                    @foreach ($i->modelSeries as $model)
                                        <a href="">
                                            <div class="item">
                                                {{ $model->name }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- mobile --}}
        <div class="content-mobile ">
            <div class="row">
                <div class="col-1">
                    <div class="category-product" id="button-category-product">
                        <div class="content d-flex">
                            <div class="btn-menu">
                                <img src="{{ asset('asset/outside/icon/menu.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset('asset/outside/logo.svg') }}" alt="Logo Ktech">
                        </a>
                    </div>
                </div>
                <div class="col-1">
                    <div class="cart">
                        <div class="circle-cart btn-cart">
                            <img src="{{ asset('asset/outside/icon/cart.png') }}" alt="Icon cart">
                            @auth('customers')
                                <div class="quantity-item-cart">
                                    {{ checkCountCart(Auth::guard('customers')->user()->id) }}
                                </div>
                            @endauth
                            @guest('customers')
                                <div class="quantity-item-cart">
                                    0
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="search-bar">
                        <input type="text" name="keyword" id="input-search-bar"
                            placeholder="Nhập từ khoá sản phẩm cần tìm">
                        <div class="circle-icon" id="circle-icon">
                            <i class="uil-search" id="icon-search"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-mobile">
            <div class="header-bar">
                <div class="logo">
                    <img src="{{ asset('asset/outside/logo.svg') }}" alt="Logo Ktech">
                </div>
                <div id="btn-close">
                    <i class="uil-multiply"></i>
                </div>
            </div>
            <div class="main-content">
                @auth('customers')
                    @php
                        $account_name = Auth::guard('customers')->user()->name ?? '';
                    @endphp
                    <a href="{{ route('home.profile') }}" class="text-dark">
                        <div class="profile d-flex gap-2 align-items-center ps-2">
                            <i class="uil uil-user fs-3 d-flex align-center "></i>
                            <span class="user-name fs-4 fw-medium">{{ $account_name }}</span>
                        </div>
                    </a>
                @endauth
                @guest('customers')
                    <a href="{{ route('home.login') }}" class="text-dark">
                        <div class="profile d-flex gap-2 align-items-center ps-2">
                            <i class="uil uil-sign-in-alt fs-3 d-flex align-center"></i>
                            <span class="user-name fs-4 fw-medium">Đăng nhập</span>
                        </div>
                    </a>
                @endguest
                <div class="item d-flex toggle-dropdown">
                    <div class="title fs-4 fw-bold">
                        Laptop
                    </div>
                    <div class="icon-arrow fs-2">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="item-dropdown">
                    @foreach (getDataBrandLaptop() as $i)
                        <div class="item">
                            {{ $i->name }}
                        </div>
                    @endforeach
                </div>
                <div class="item d-flex toggle-dropdown">
                    <div class="title fs-4 fw-bold">
                        Điện thoại
                    </div>
                    <div class="icon-arrow fs-2">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="item-dropdown">
                    <div class="item">
                        APPLE
                    </div>
                    <div class="item">
                        XIAOMI
                    </div>
                    <div class="item">
                        SAMSUNG
                    </div>
                </div>
                <div class="item d-flex toggle-dropdown">
                    <div class="title fs-4 fw-bold">
                        Phụ kiện
                    </div>
                    <div class="icon-arrow fs-2">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-action d-none">
        <div class="modal-action-overlay">
            <div class="modal-action-content">
                <span class="modal-action-close"><i class="uil-multiply"></i></span>
                <div class="logo">
                    <img src="{{ asset('asset/admin/systemImage/ktech-dark.svg') }}" alt="Logo Ktech">
                </div>
                <div class="text-review">
                    Để sử dụng các chức năng của K-Tech vui lòng đăng nhập
                </div>
                <div class="btn-action">
                    <div class="btn-register">
                        Đăng ký
                    </div>
                    <div class="btn-login">
                        Đăng nhập
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        const searchRoute = "{{ route('home.searchProcess') }}";
        const authCheckStatus = "{{ route('home.authStatus') }}";
        const routeProfile = "{{ route('home.profile') }}";
    </script>
@endpush
