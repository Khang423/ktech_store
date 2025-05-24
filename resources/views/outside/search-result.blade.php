@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <div class="breadcrumb1">
        <a href="{{ route('home.index') }}">
            <span class="text-primary">
                Trang chủ
            </span>
        </a>
        <i class=" uil-angle-right-b"></i>
        <span class="text-primary">Tìm kiếm sản phẩm</span>
        <i class=" uil-angle-right-b"></i>
        <span>{{ $keyword }}</span>
    </div>
    <hr>
    <div class="product-title mt-3">
        <h2 class="text-dark">
            Kết quả tìm kiếm sản phẩm "{{ $keyword }}"
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
@endsection
