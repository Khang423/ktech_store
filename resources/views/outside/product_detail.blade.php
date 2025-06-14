@extends('outside.layout.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/libraries/fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraries/fancybox/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraries/fancybox/carousel.thumbs.css') }}">
@endpush
@section('content')
    <div class="empty"></div>
    <div class="breadcrumb1">
        <a href="{{ route('home.index') }}">
            <span class="text-primary">
                Trang chủ
            </span>
        </a>
        <i class=" uil-angle-right-b"></i>
        <span class="text-primary">
            @if ($product->laptopSpecs)
                Laptop
            @elseif ($product->phoneSpecs)
                Điện thoại
            @endif
        </span>
        <i class=" uil-angle-right-b"></i>
        <span>{{ $product->name }}</span>
    </div>
    <hr>
    <section class="section-product-info">
        <div class="product-image">
            <div class="f-carousel" id="product-image-carousel">
                @foreach ($product->productImages as $item)
                    <a class="f-carousel__slide"
                        href="{{ asset('asset/admin/products') . '/' . $item->product_id . '/image/' . $item->image }}"
                        data-thumb-src="{{ asset('asset/admin/products') . '/' . $item->product_id . '/image/' . $item->image }}"
                        data-fancybox="gallery"
                        data-download-src="{{ asset('asset/admin/products') . '/' . $item->product_id . '/image/' . $item->image }}">
                        <img width="250px" height="250px"
                            data-lazy-src="{{ asset('asset/admin/products') . '/' . $item->product_id . '/image/' . $item->image }}"
                            alt="{{ $product->slug }}">
                    </a>
                @endforeach
            </div>
        </div>
        <div class="product-detail-info">
            <div class="product-versions">
                @for ($i = 1; $i < 3; $i++)
                    <div class="version-card">
                        <span class="card-active"><i class="uil-check"></i></span>
                        <div class="content-card">
                            <div class="product-version-name">
                                TECNO CAMON 40 Pro 8GB 256GB
                            </div>
                            <div class="product-version-price">
                                {{ formatPriceToVND(122200003) }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <hr>
            <div class="product-price">
                <div class="btn-price">
                    {{ formatPriceToVND($product->price) }}
                </div>
                <div class="product-buy mt-2">
                    <div class="btn-buy">
                        <span>
                            MUA NGAY
                        </span>
                    </div>
                    @if (Auth::guard('customers')->check())
                        <div class="btn-add_to_cart" data-product-id={{ $product->id }}>
                            <img src="{{ asset('asset/outside/icon/add-to-cart.png') }}" alt="Icon-add-to-cart">
                            <span>
                                Thêm vào giỏ
                            </span>
                        </div>
                    @else
                        <div class="btn-add_to_cart" id="guest-add-to-cart">
                            <img src="{{ asset('asset/outside/icon/add-to-cart.png') }}" alt="Icon-add-to-cart">
                            <span>
                                Thêm vào giỏ
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="section-description">
        <div class="content d-flex">
            <div class="product-description">
                <div class="title">
                    MÔ TẢ SẢN PHẨM
                </div>
                <div class="content">
                    {!! $product->description !!}
                </div>
            </div>
            <div class="product-info">
                <div class="title">
                    THÔNG SỐ KỸ THUẬT
                </div>
                @php
                    $laptopSpecs = getLaptopSpecs($product);
                    $phoneSpecs = getPhoneSpecs($product);
                @endphp
                @if ($product->laptopSpecs)
                    <div class="content">
                        @if ($laptopSpecs['gpu'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Card đồ hoạ</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['gpu'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['cpu'])
                            <div class="item">
                                <div class="name-item">
                                    <span>CPU</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['cpu'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['ram_size'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Dung lượng Ram</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['ram_size'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['ram_type'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Loại Ram</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['ram_type'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['storage_size'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Ổ cứng</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['storage_size'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['display_size'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Kích thước màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['display_size'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['display_resolution'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Độ phân giải màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['display_resolution'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['display_technology'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Công nghệ màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['display_technology'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['battery'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Pin</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['battery'] }}
                                </div>
                            </div>
                        @endif
                        @if ($laptopSpecs['usb_ports'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Cổng giao tiếp</span>
                                </div>
                                <div class="value-item">
                                    {{ $laptopSpecs['usb_ports'] }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @if ($product->phoneSpecs)
                    <div class="content">
                        @if ($phoneSpecs['display_size'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Kích thước màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['display_size'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['display_type'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Công nghệ màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['display_type'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['rear_camera'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Camera sau</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['rear_camera'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['front_camera'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Camera trước</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['front_camera'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['chipset'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Chipset</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['chipset'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['nfc_support'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Công nghệ NFC</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['nfc_support'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['ram_size'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Dung lượng Ram</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['ram_size'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['storage_size'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Bộ nhớ trong</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['storage_size'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['sim_type'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Thẻ sim</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['sim_type'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['battery_capacity'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Pin</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['battery_capacity'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['operating_system'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Hệ điều hành</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['operating_system'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['display_resolution'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Độ phân giải màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['display_resolution'] }}
                                </div>
                            </div>
                        @endif
                        @if ($phoneSpecs['display_features'])
                            <div class="item">
                                <div class="name-item">
                                    <span>Tính năng màn hình</span>
                                </div>
                                <div class="value-item">
                                    {{ $phoneSpecs['display_features'] }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="btn-info-detail">
                    Xem cấu hình chi tiết
                </div>
            </div>
            <div class="product-info-detail-overlay d-none">
            </div>
            <div class="product-info-detail">
                <div class="info-detail-header">
                    <div class="title text-dark">
                        THÔNG SỐ NỔI BẬT
                    </div>
                    <div class="btn-product-info-detail-close">
                        <i class="uil-multiply"></i>
                    </div>
                    <div class="btn-product-info-detail-close-mobile">
                        <i class="uil-multiply"></i>
                    </div>
                </div>
                <div class="info-detail-main">
                    <div class="product-thumbnail">
                        <img src="{{ asset('asset/admin/products') . '/' . $product->id . '/' . $product->thumbnail }}"
                            alt="">
                    </div>
                    @if ($product->laptopSpecs)
                        <div class="content">
                            <div class="title-item">
                                <span>Bộ xử lý và Card đồ hoạ</span>
                            </div>
                            @if ($laptopSpecs['gpu'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Card đồ hoạ</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['gpu'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['cpu'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>CPU</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['cpu'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Bộ nhớ RAM, Ổ cứng</span>
                            </div>
                            @if ($laptopSpecs['ram_size'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Dung lượng Ram</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['ram_size'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['ram_type'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Loại Ram</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['ram_type'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['storage_size'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Ổ cứng</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['storage_size'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Màn hình</span>
                            </div>
                            @if ($laptopSpecs['refresh_rate'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Tân số quét</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['refresh_rate'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['display_panel'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Chất liệu tấm nền </span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['display_panel'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['display_size'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Kích thước màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['display_size'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['display_technology'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Công nghệ màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['display_technology'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['display_resolution'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Độ phân giải màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['display_resolution'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Âm thanh</span>
                            </div>
                            @if ($laptopSpecs['audio_technology'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Công nghệ âm thanh</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['audio_technology'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Cổng kết nối</span>
                            </div>
                            @if ($laptopSpecs['memory_card_slot'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Khe đọc thẻ nhớ</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['memory_card_slot'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['wifi'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Wifi</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['wifi'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['bluetooth_version'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Bluetooth</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['bluetooth_version'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['usb_ports'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Cổng giao tiếp</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['usb_ports'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Tính năng khác</span>
                            </div>
                            @if ($laptopSpecs['keyboard_type'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Loại bàn phím</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['keyboard_type'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['security'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Bảo mật</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['security'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['webcam'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Webcam</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['webcam'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['operating_system'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Hệ điều hành</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['operating_system'] }}
                                    </div>
                                </div>
                            @endif

                            <div class="title-item">
                                <span>Tiện ích khác</span>
                            </div>
                            @if ($laptopSpecs['other_feature'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Tiện ích khác</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['other_feature'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Pin & Công nghệ sạc</span>
                            </div>
                            @if ($laptopSpecs['battery'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Pin</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['battery'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Kích thước & Trọng lượng</span>
                            </div>
                            @if ($laptopSpecs['dimension'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Kích thước</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['dimension'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['weight'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Trọng lượng</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['weight'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($laptopSpecs['material'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Chất liệu</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['material'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Ngày phát hành</span>
                            </div>
                            @if ($laptopSpecs['release_date'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Ngày phát hành</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $laptopSpecs['release_date'] }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($product->phoneSpecs)
                        <div class="content">
                            <div class="title-item">
                                <span>Màn hình</span>
                            </div>
                            @if ($phoneSpecs['display_size'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['display_size'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['display_type'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Loại màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['display_type'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['display_resolution'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Độ phân giải màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['display_resolution'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['display_refresh_rate'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Tần số quét</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['display_refresh_rate'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['display_features'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Tính năng màn hình</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['display_features'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Camera sau</span>
                            </div>
                            @if ($phoneSpecs['rear_camera'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Camera sau</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['rear_camera'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['camera_features'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Tính năng Camera</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['camera_features'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Camera Trước</span>
                            </div>
                            @if ($phoneSpecs['front_camera'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Camera Trước</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['front_camera'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Chip xử lý & Card đồ hoạ</span>
                            </div>
                            @if ($phoneSpecs['chipset'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Chipset</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['chipset'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['gpu'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Card đồ hoạ</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['gpu'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Giao tiếp & Kết nối</span>
                            </div>
                            @if ($phoneSpecs['nfc_support'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Công nghệ NFC</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['nfc_support'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['sim_type'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Thẻ sim</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['sim_type'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['network_support'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>THỗ trợ mạng</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['network_support'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['gps_support'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>GPS</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['gps_support'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Ram & Lưu trữ</span>
                            </div>
                            @if ($phoneSpecs['ram_size'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Dung lượng Ram</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['ram_size'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['storage_size'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Bộ nhớ trong</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['storage_size'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Pin & Công nghệ sạc</span>
                            </div>
                            @if ($phoneSpecs['battery_capacity'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Pin</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['battery_capacity'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['charging_technology'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Công nghệ sạc</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['charging_technology'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['charging_port'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Cổng sạc</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['charging_port'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Tính năng khác</span>
                            </div>
                            @if ($phoneSpecs['operating_system'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Hệ điều hành</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['operating_system'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Kích thước & Trọng lượng</span>
                            </div>
                            @if ($phoneSpecs['weight'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Trọng lượng</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['weight'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['dimension'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Kích thước</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['dimension'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Thiết kế</span>
                            </div>
                            @if ($phoneSpecs['frame_material'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Chất liệu khung viền</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['frame_material'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Thông số khác</span>
                            </div>
                            @if ($phoneSpecs['water_dust_resistance'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Chỉ số kháng nước, bụi</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['water_dust_resistance'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['audio_technology'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Công nghệ âm thanh</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['audio_technology'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['fingerprint_sensor'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Cảm biến vân tay</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['fingerprint_sensor'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['other_sensors'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Cảm biến khác</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['other_sensors'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['wifi_technology'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Wifi</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['wifi_technology'] }}
                                    </div>
                                </div>
                            @endif
                            @if ($phoneSpecs['bluetooth_technology'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Bluetooth</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['bluetooth_technology'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="title-item">
                                <span>Ngày phát hành</span>
                            </div>
                            @if ($phoneSpecs['release_date'])
                                <div class="item">
                                    <div class="name-item">
                                        <span>Ngày phát hành</span>
                                    </div>
                                    <div class="value-item">
                                        {{ $phoneSpecs['release_date'] }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="section-preview">
        danh gia va binh luan
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/libraries/fancybox/fancybox.umd.js') }}"></script>
    <script src="{{ asset('js/libraries/fancybox/carousel.umd.js') }}"></script>
    <script src="{{ asset('js/libraries/fancybox/carousel.thumbs.umd.js') }}"></script>
    <script src="{{ asset('js/libraries/fancybox/config_fancybox.js') }}"></script>
    <script src="{{ asset('js/libraries/fancybox/config_carousel.js') }}"></script>
    <script src="{{ asset('js/outside/product_detail.js') }}"></script>
    <script>
        const routeAddItemToCart = "{{ route('home.addItemToCart') }}";
    </script>
@endpush
