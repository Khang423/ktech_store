@php
    use App\Enums\TagEnums;
@endphp
@extends('outside.layout.master')
@push('js')
    <link href="{{ asset('css/outside/section-laptop.css') }}" rel="stylesheet" type="text/css" />
@endpush
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
            <div class="item" data-name="brand">
                <div class="title">
                    <div class="name">
                        Thương hiệu
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($brand as $i)
                        <div class="item" data-name="{{ $i->name }}">
                            <div class="checkbox">
                                <input type="checkbox">
                            </div>
                            <div class="title">
                                {{ $i->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- core cpu --}}
            <div class="item" data-name="cpu">
                <div class="title">
                    <div class="name">
                        CPU
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::CORE_CPU)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- graphics card --}}
            <div class="item" data-name="graphic_card">
                <div class="title">
                    <div class="name">
                        Card đồ hoạ rời
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::GRAPHICS_CARD)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- display size --}}
            <div class="item" data-name="display_size">
                <div class="title">
                    <div class="name">
                        Kích thước màn hình
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::DISPLAY_SIZE)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- ram size --}}
            <div class="item" data-name="ram_size">
                <div class="title">
                    <div class="name">
                        Dung lượng RAM
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::RAM_SIZE)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- ssd size --}}
            <div class="item" data-name="ssd_size">
                <div class="title">
                    <div class="name">
                        Dung lượng SSD
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::SSD_SIZE)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- display resolution --}}
            <div class="item" data-name="display_resolution">
                <div class="title">
                    <div class="name">
                        Độ phân giải màn hình
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::DISPLAY_RESOLUTION)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- usage needs --}}
            <div class="item" data-name="usage_need">
                <div class="title">
                    <div class="name">
                        Nhu cầu sử dụng
                    </div>
                    <div class="icon-arrow">
                        <i class="uil uil-angle-down"></i>
                    </div>
                </div>
                <div class="content">
                    @foreach ($tag as $i)
                        @if ($i->slug === TagEnums::USAGE_NEEDS)
                            @foreach ($i->tagDetails as $tagDetails)
                                <div class="item" data-name="{{ $tagDetails->name }}">
                                    <div class="checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="title">
                                        {{ $tagDetails->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="view-product">
            <section id="section-laptop">
                @foreach ($product as $item)
                    <div class="card-product" data-id="{{ $item->id }}" data-slug="{{ $item->slug }}">
                        <div class="product-content" data-id="product-id">
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
                @endforeach
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/outside/search-result.js') }}"></script>
    <script></script>
@endpush
