<div class="header">
    <div class="container justify-content-center">
        {{-- desktop --}}
        <div class="content">
            <div class="row">
                <div class="col-2">
                    <div class="logo">
                        <img src="{{ asset('asset/outside/logo.svg') }}" alt="Logo Ktech">
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-3">
                            <div class="category-product" id="button-category-product">
                                <div class="content d-flex">
                                    <div class="menu">
                                        <img src="{{ asset('asset/outside/icon/menu.svg') }}" alt="">
                                    </div>
                                    <div class="title">
                                        Danh mục
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="search-bar">
                                <div class="content">
                                    <input type="text" name="keyword" id="input-search-bar"
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
                            <div class="circle-user">
                                <img src="{{ asset('asset/outside/icon/user.png') }}" alt="Icon user">
                            </div>
                        </div>
                        <div class="cart">
                            <div class="content">
                                <div class="border-cart d-flex">
                                    <div class="icon-cart">
                                        <img src="{{ asset('asset/outside/icon/cart.png') }}" alt="Icon cart">
                                    </div>
                                    <div class="circle-quantity-item-cart">
                                        2
                                    </div>
                                    <div class="title">
                                        Giỏ hàng
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <img src="{{ asset('asset/outside/logo.svg') }}" alt="Logo Ktech">
                    </div>
                </div>
                <div class="col-1">
                    <div class="cart">
                        <div class="circle-cart">
                            <img src="{{ asset('asset/outside/icon/cart.png') }}" alt="Icon cart">
                            <div class="quantity-item-cart">
                                2
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="search-bar">
                        <input type="text" name="keyword" id="input-search-bar"
                            placeholder="Nhập tên điện thoại, laptop, phụ kiền... cần tìm">
                        <div class="circle-icon">
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
            <div class="mobile-content">
                <div class="header-content d-flex">
                    <div class="content-left d-flex">
                        <div class="btn-register mt-2">
                            <span>Đăng ký</span>
                        </div>
                        <div class="btn-login mt-2">
                            <span>Đăng nhập</span>
                        </div>
                    </div>
                    <div class="content-right">
                        <img src="https://fptshop.com.vn/img/login_mobile.png?w=360&q=75" alt="">
                    </div>
                </div>
                <div class="main-content d-flex flex-column">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="item d-flex">
                                <div class="item-icon">
                                    <img src="{{ asset('asset/outside/icon/fire.png') }}"
                                        alt="">
                                </div>
                                <div class="item-name d-flex ">
                                    Iphone
                                </div>
                            </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="contact-content d-flex">
            @for ($i = 1; $i < 10; $i++)
                <div class="contact-item">
                    Hiper
                </div>
            @endfor
        </div>
    </div>
    <div class="modal-nemnu-overlay d-none">
        <div class="modal-menu-category">
            <div class="menu-category-content d-flex">
                <div id="button-close-category-product">
                    <i class="uil-multiply"></i>
                </div>
                <div class="category-name d-flex flex-column">
                    @for ($i = 1; $i < 10; $i++)
                        <div class="item d-flex">
                            <div class="icon-category">
                                <i class=" uil-laptop"></i>
                            </div>
                            <div class="title-category">
                                Laptop
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="child-category">
                    <div class="child-category-name d-flex">
                        <img src="{{ asset('asset/outside/icon/fire.png') }}" alt="">
                        <span>Gợi ý cho bạn</span>
                    </div>
                    <div class="child-category-content ">
                        @for ($i = 1; $i < 10; $i++)
                            <div class="item">
                                <div class="item-thumbnail">
                                    <img src="{{ asset('asset/admin/products/2/thumbnail_6820050d6115b.webp') }}"
                                        alt="">
                                </div>
                                <div class="item-name d-flex ">
                                    Iphone
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
