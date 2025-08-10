@extends('outside.layout.master')
@section('content')
    <div class="empty" style="margin-top: 5rem;"></div>
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
    <div class="product-title mt-3">
        <h3 class="text-dark">
            LAPTOP MỚI
        </h3>
    </div>
    <section id="section-laptop">
        <div class="swiper-product-item">
            <div class="swiper-wrapper">
                @foreach ($product_version as $item)
                    @if ($item->products->category_product_id == 1)
                        <div class="swiper-slide">
                            <div class="card-product" data-id="{{ $item->id }}" data-slug="{{ $item->slug }}">
                                <div class="product-content" data-id="product-id">
                                    <div class="product-discount d-flex"></div>
                                    <div class="product-thumbnail">
                                        <img src="{{ asset('asset/admin/products/' . $item->products->id . '/' . $item->products->thumbnail) }}"
                                            alt="">
                                    </div>
                                    <div class="product-title">
                                        {{ $item->config_name }}
                                    </div>
                                    <div class="product-price">
                                        @if ($item->final_price > 0)
                                            {{ formatPriceToVND($item->final_price) }}
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <div class="product-title mt-3">
        <h3 class="text-dark">
            ĐIỆN THOẠI
        </h3>
    </div>
    <section id="section-laptop">
        <div class="swiper-product-item">
            <div class="swiper-wrapper">
                @foreach ($product_version as $item)
                    @if ($item->products->category_product_id == 2)
                        <div class="swiper-slide">
                            <div class="card-product" data-id="{{ $item->id }}" data-slug="{{ $item->slug }}">
                                <div class="product-content" data-id="product-id">
                                    <div class="product-discount d-flex"></div>
                                    <div class="product-thumbnail">
                                        <img src="{{ asset('asset/admin/products/' . $item->products->id . '/' . $item->products->thumbnail) }}"
                                            alt="">
                                    </div>
                                    <div class="product-title">
                                        {{ $item->config_name }}
                                    </div>
                                    <div class="product-price">
                                        @if ($item->final_price > 0)
                                            {{ formatPriceToVND($item->final_price) }}
                                        @else
                                            Đang cập nhật
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(() => {
            checkURLHome();
            $(window).resize(function() {
                checkURLHome();
            });
        });
        const checkURLHome = () => {
            if (window.location.href.includes("/") && window.innerWidth <= 768) {
                $(".empty").css("margin-top", "7.8rem");
            } else {
                $(".empty").css("margin-top", "5rem");
            }
        };
    </script>
@endpush
