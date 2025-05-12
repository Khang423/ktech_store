@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <section id="section-slide">
        <div class="swiper-banner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img
                        src="https://cdn2.cellphones.com.vn/insecure/rs:fill:690:300/q:90/plain/https://dashboard.cellphones.com.vn/storage/iphone-16-pro-max-thu-cu-moi-home.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:690:300/q:90/plain/https://dashboard.cellphones.com.vn/storage/s25-home-moi.png"
                        alt="">
                </div>
                <div class="swiper-slide">
                    <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:690:300/q:90/plain/https://dashboard.cellphones.com.vn/storage/vivo-v50-home.png"
                        alt="">
                </div>
            </div>
            <div class="swiper-pagination">
            </div>
        </div>
    </section>
    <section id="section-category-product">
        <div class="swiper-category-product">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 10; $i++)
                    <div class="swiper-slide">
                        <div class="category-product-card">
                            <div class="category-product-content d-flex flex-column  ">
                                <div class="category-product-thumbnail">
                                    <img src="{{ asset('asset/admin/products/2/thumbnail_6820050d6115b.webp') }}"
                                        alt="">
                                </div>
                                <div class="category-product-name">
                                    Điện thoại
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <div class="product-title mt-3">
        <h2 class="text-dark">
            LAPTOP
        </h2>
    </div>
    <section id="section-laptop">
        <div class="swiper-product-item">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 9; $i++)
                    <div class="swiper-slide">
                        <div class="card-product ">
                            <div class="product-content" data-id="product-id">
                                <div class="product-discount d-flex">
                                    <img src="{{ asset('asset/outside/icon/sale.png') }}" alt="Icon sale">
                                    <div class="percent-discount">
                                        Giảm 30%
                                    </div>
                                </div>
                                <div class="product-thumbnail">
                                    <img src="{{ asset('asset/admin/products/2/thumbnail_6820050d6115b.webp') }}"
                                        alt="Product Image">
                                </div>
                                <div class="product-title ">
                                    iPhone 16 Pro Max 256GB | Chính hãng VN/A
                                </div>
                                <div class="product-price">
                                    30.000.000đ
                                </div>
                                <div class="product-rate d-flex">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <div class="title-heart">
                                        Yêu thích
                                    </div>
                                    <div class="icon-heart">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <div class="product-title mt-3">
        <h2 class="text-dark">
            ĐIỆN THOẠI
        </h2>
    </div>
    <section id="section-laptop">
        <div class="swiper-product-item">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 5; $i++)
                    <div class="swiper-slide">
                        <div class="card-product">
                            <div class="product-content" data-id="product-id">
                                <div class="product-discount d-flex">
                                    <img src="{{ asset('asset/outside/icon/sale.png') }}" alt="Icon sale">
                                    <div class="percent-discount">
                                        Giảm 30%
                                    </div>
                                </div>
                                <div class="product-thumbnail">
                                    <img src="{{ asset('asset/admin/products/2/thumbnail_6820050d6115b.webp') }}"
                                        alt="Product Image">
                                </div>
                                <div class="product-title ">
                                    iPhone 16 Pro Max 256GB | Chính hãng VN/A
                                </div>
                                <div class="product-price">
                                    30.000.000đ
                                </div>
                                <div class="product-rate d-flex">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
                                    <div class="title-heart">
                                        Yêu thích
                                    </div>
                                    <div class="icon-heart">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
