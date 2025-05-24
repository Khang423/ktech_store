@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <section id="section-slide">
        <div class="swiper-banner">
            <div class="swiper-wrapper">
                @foreach ($banners as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset('asset/admin/banners') }}/{{ $item->banner }}" alt="{{ $item->slug }}">
                    </div>
                @endforeach
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
                @foreach ($product as $item)
                    <div class="swiper-slide">
                        <div class="card-product" data-id="{{ $item->id }}" data-slug="{{ $item->slug }}">
                            <div class="product-content" data-id="product-id">
                                <div class="product-discount d-flex">
                                    <img src="{{ asset('asset/outside/icon/sale.png') }}" alt="Icon sale">
                                    <div class="percent-discount">
                                        Giảm 30%
                                    </div>
                                </div>
                                <div class="product-thumbnail">
                                    <img src="{{ asset('asset/admin/products') . '/' . $item->id . '/' . $item->thumbnail }}"
                                        alt="">
                                </div>
                                <div class="product-title ">
                                    {{ $item->name }}
                                </div>
                                <div class="product-price">
                                    {{ formatPriceToVND($item->price) }}
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
                @endforeach
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
                @foreach ($product as $item)
                    <div class="swiper-slide">
                        <div class="card-product" data-id="{{ $item->id }}" data-slug="{{ $item->slug }}">
                            <div class="product-content" data-id="product-id">
                                <div class="product-discount d-flex">
                                    <img src="{{ asset('asset/outside/icon/sale.png') }}" alt="Icon sale">
                                    <div class="percent-discount">
                                        Giảm 30%
                                    </div>
                                </div>
                                <div class="product-thumbnail">
                                    <img src="{{ asset('asset/admin/products') . '/' . $item->id . '/' . $item->thumbnail }}"
                                        alt="">
                                </div>
                                <div class="product-title ">
                                    {{ $item->name }}
                                </div>
                                <div class="product-price">
                                    {{ formatPriceToVND($item->price) }}
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
                @endforeach
            </div>
        </div>
    </section>
    <section class="support-section mt-5">
        <div class="content d-flex">
            <div class="item">
                <div class="icon">
                    <img src="{{ asset('asset/outside/icon/policy3.svg') }}" alt="">
                </div>
                <div class="title">
                    Thương hiệu đảm bảo
                </div>
                <div class="description">
                    Nhập khẩu, bảo hành chính hãng
                </div>
            </div>
            <div class="item">
                <div class="icon">
                    <img src="{{ asset('asset/outside/icon/policy1.svg') }}" alt="">
                </div>
                <div class="title">
                    Đổi trả dễ dàng
                </div>
                <div class="description">
                    Theo chính sách đổi trả tại FPT Shop
                </div>
            </div>
            <div class="item">
                <div class="icon">
                    <img src="{{ asset('asset/outside/icon/policy4.svg') }}" alt="">
                </div>
                <div class="title">
                    Sản phẩm chất lượng
                </div>
                <div class="description">
                    Đảm bảo tương thích và độ bền cao
                </div>
            </div>
            <div class="item">
                <div class="icon">
                    <img src="{{ asset('asset/outside/icon/policy2.svg') }}" alt="">
                </div>
                <div class="title">
                    Giao hàng tận nơi
                </div>
                <div class="description">
                    Tại 63 tỉnh thành
                </div>
            </div>
        </div>
    </section>
@endsection
