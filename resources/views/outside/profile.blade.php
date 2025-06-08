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
        <span class="text-primary">
            Thông tin cá nhân
        </span>
    </div>
    <hr>
    <section class="section-profile">
        <div class="main">
            <div class="header-profile">
                <div class="customer-info">
                    <div class="avatar">
                        <div class="avatar-circle">
                            <img src="{{ asset('asset/admin/systemImage/ktech-dark.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="information">
                        <div class="name">
                            khang
                        </div>
                        <div class="tel">
                            07995990500
                        </div>
                    </div>
                </div>
                <div class="sum-ordered">
                    <div class="icon-order">
                        <div class="order-circle">
                            <img src="{{ asset('asset/outside/icon/cart-profile.png') }}" alt="">
                        </div>
                    </div>
                    <div class="information">
                        <div class="quantity">
                            2
                        </div>
                        <div class="title">
                            Tổng số đơn hàng đã mua
                        </div>
                    </div>
                </div>
                <div class="total-price">
                    <div class="icon-invoice">
                        <div class="invoice-circle">
                            <img src="{{ asset('asset/outside/icon/invoice.png') }}" alt="">
                        </div>
                    </div>
                    <div class="information">
                        <div class="sum-total">
                            0đ
                        </div>
                        <div class="title">
                            Tổng tiền tích lũy Từ 01/01/2025
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard">
                <div class="main">
                    <div class="sidebar">
                        <div class="item">
                            <div class="icon">
                                <i class="uil uil-home"></i>
                            </div>
                            <div class="title">
                                Tổng quan
                            </div>
                        </div>
                        <div class="item btn-purchase-history ">
                            <div class="icon">
                                <i class="uil uil-bill"></i>
                            </div>
                            <div class="title">
                                Lịch sử mua hàng
                            </div>
                        </div>
                        <div class="item btn-account-info">
                            <div class="icon">
                                <i class="uil uil-user-square"></i>
                            </div>
                            <div class="title">
                                Thông tin tài khoản
                            </div>
                        </div>
                        <a href="{{ route('home.logout') }}">
                            <div class="item">
                                <div class="icon">
                                    <i class="uil uil-sign-out-alt"></i>
                                </div>
                                <div class="title">
                                    Đăng xuất
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="content ">
                        <div class="purchase-history d-none">
                            <div class="order-status">
                                <div class="item active" id="order-all">
                                    Tất cả
                                </div>
                                <div class="item" id="status-pending">
                                    Chờ xác nhận
                                </div>
                                <div class="item" id="status-1">
                                    Đã xác nhận
                                </div>
                                <div class="item" id="status-2">
                                    Đang vận chuyển
                                </div>
                                <div class="item" id="status-3">
                                    Đã giao hàng
                                </div>
                                <div class="item" id="status-4">
                                    Đã huỷ
                                </div>
                            </div>
                            <div class="search-by-date">
                                <div class="title"> Lịch sử mua hàng : </div>
                                <div class="from-date date">
                                    <input type="text" id="start-date" name="start-date" placeholder="Từ ngày">
                                </div>
                                <i class="uil uil-arrow-right" style="font-size: 20px"></i>
                                <div class="to-date date">
                                    <input type="text" id="end-date" name="end-date" placeholder="Đến ngày">
                                </div>
                            </div>
                            <div class="view mt-2">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="item mb-2">
                                        <div class="item-header">
                                            <div class="left">
                                                <div class="id-order">
                                                    Đơn hàng : sấdfasd
                                                </div>
                                                <div class="order-date">
                                                    Ngày đặt hàng :
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="order-status cancel">
                                                    Trạng thái
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-content mt-1">
                                            <div class="left">
                                                <div class="thumbnail">
                                                    <img src="{{ asset('asset/admin/products/1/thumbnail_683fabf1ae166.webp') }}"
                                                        alt="">
                                                </div>
                                                <div class="product-info">
                                                    <div class="name">
                                                        Macbook Pro M4
                                                    </div>
                                                    <div class="price">
                                                        {{ formatPriceToVND(39900000) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="order-total">
                                                    Tổng thanh toán : <span
                                                        style="font-size: 16px;font-weight: 600;color: #25449a">{{ formatPriceToVND(39900000) }}</span>
                                                </div>
                                                <div class="order-detail">
                                                    Xem chi tiết >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="account-info d-none" id="profile-account-info">
                            <div class="personal-info">
                                <div class="info-header">
                                    <div class="left">
                                        <div class="title">
                                            Thông tin cá nhân
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="btn-update">
                                            <i class="uil uil-edit"></i> Cập nhật
                                        </div>
                                    </div>
                                </div>
                                <div class="info-content">
                                    <div class="left">
                                        <div class="item">
                                            <div class="title">
                                                Họ và tên :
                                            </div>
                                            <div class="value">
                                                Võ Vĩ Khang
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="title">
                                                Giới tính :
                                            </div>
                                            <div class="value">
                                                Nam
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="title">
                                                Ngày sinh :
                                            </div>
                                            <div class="value">
                                                04/02/2003
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="item">
                                            <div class="title">
                                                Số điện thoại :
                                            </div>
                                            <div class="value">
                                                0799599040
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="title">
                                                Email:
                                            </div>
                                            <div class="value">
                                                vovykhag@gmail.com
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="title">
                                                Địa chỉ mặc định :
                                            </div>
                                            <div class="value">
                                                -
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="address-info">
                                <div class="address-header">
                                    <div class="title">
                                        Sổ địa chỉ
                                    </div>
                                    <div class="btn-add-address">
                                        <i class="uil uil-map-marker-plus"></i> Thêm địa chỉ
                                    </div>
                                </div>
                                <div class="address-content">
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="item">
                                            <div class="item-header">
                                                <div class="left">
                                                    Địa chỉ nhà ở an biên
                                                </div>
                                                <div class="right">
                                                    Nhà
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="basic-info">
                                                    <div class="name">
                                                        Võ Vĩ Khang
                                                    </div>
                                                    <div class="tel">
                                                        0799599040
                                                    </div>
                                                </div>
                                                <div class="address-info1">
                                                    Võ Vĩ Khang, 7 Chợ, Đông thái, An biên, Kiên Giang
                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="item-action">
                                                    <div class="right">
                                                        <div class="btn-delete">
                                                            Xoá
                                                        </div>
                                                        <div class="btn-update">
                                                            Cập nhật
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="other" id="password-and-connect">
                                <div class="reset-password">
                                    <div class="reset-header">
                                        <div class="title">
                                            Mật khẩu
                                        </div>
                                        <div class="btn-update-password">
                                            <i class="uil uil-edit" style="font-size: 20px"></i> Thay đổi mật khẩu
                                        </div>
                                    </div>
                                    <div class="reset-content">
                                        <div class="left">
                                            Cập nhật lần cuối lúc :
                                        </div>
                                        <div class="right">
                                            04/05/2024 15:16
                                        </div>
                                    </div>
                                </div>
                                <div class="linked-accounts">
                                    <div class="title">
                                        Tài khoản liên kết
                                    </div>
                                    <div class="item">
                                        <div class="left">
                                            Google
                                        </div>
                                        <div class="right">
                                            Trạng thái
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="left">
                                            Zalo
                                        </div>
                                        <div class="right">
                                            Trạng thái
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/outside/profile.js') }}"></script>
@endpush
