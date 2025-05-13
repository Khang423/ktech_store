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
                        <div class="category-product-card" data-id="{{ $i }}" data-name="{{ $i . 'name' }}">
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
                                    <img src="data:image/jpeg;base64,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"
                                        alt="Product Image">
                                </div>
                                <div class="product-title ">
                                    MacBook Air M4 13 inch 2025 10CPU 8GPU 16GB 256GB | Chính hãng Apple Việt Nam
                                </div>
                                <div class="product-price">
                                    30.000.000đ
                                </div>
                                <div class="product-note">
                                    Không phí chuyển đổi khi trả góp 0% qua thẻ tín dụng kỳ hạn 3-6 tháng
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
                                <div class="product-note">
                                    Không phí chuyển đổi khi trả góp 0% qua thẻ tín dụng kỳ hạn 3-6 tháng
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
