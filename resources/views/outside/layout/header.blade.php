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
        </div>
    </div>
    <div class="contact">
    </div>
</div>

