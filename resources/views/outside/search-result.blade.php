@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <div class="breadcrumb1">
        <div class="container">
            <a href="{{ route('home.index') }}">
                <span style="color:#2a52be">
                    Trang chủ
                </span>
            </a>
            <i class=" uil-angle-right-b"></i>
            <span style="color:#2a52be">
                Tìm sản phẩm
            </span>
        </div>
    </div>
    <div class="section-search">
        <div class="option">
            <div class="content-search">
                <div class="title">
                    Bộ lọc tìm kiếm
                </div>
                <div class="content">

                </div>
            </div>
            <div class="range-price">
                <div class="title">
                    <span>
                        Chọn khoảng giá
                    </span>
                </div>
                <div class="content">
                    <div class="input-price">
                        <div class="start-price">
                            <input type="text">
                        </div>
                        <span class="d-flex justify-content-center align-items-center fs-3"> - </span>
                        <div class="end-price">
                            <input type="text">
                        </div>
                    </div>
                    <div class="animation-ragne-price">
                        <input type="range">
                    </div>
                </div>
            </div>
            <div class="item" data-id="1">
                <div class="title">
                    <div class="name">
                        Series Model
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Macbook Pro
                        </div>
                    </div>
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Macbook Air
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" data-id="3">
                <div class="title">
                    <div class="name">
                        Cấu hình
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Core I5
                        </div>
                    </div>
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Core I7
                        </div>
                    </div>
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Core I9
                        </div>
                    </div>
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Ryzen R5
                        </div>
                    </div>
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Ryzen R7
                        </div>
                    </div>
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            Ryzen R9
                        </div>
                    </div>
                </div>
            </div>
            <div class="item" data-id="2">
                <div class="title">
                    <div class="name">
                        Ram
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            512GB
                        </div>
                    </div>
                     <div class="item">
                        <div class="checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="title">
                            1TB
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-product">
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
                                            {{ formatPriceToVND($item->final_price) }}
                                        </div>
                                        <div class="product-rate d-flex">
                                            <img src="{{ asset('asset/outside/icon/star.png') }}" alt="">
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
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/outside/search-result.js') }}"></script>
    <script></script>
@endpush
