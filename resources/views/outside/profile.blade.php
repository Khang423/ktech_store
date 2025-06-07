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
                <div class="sidebar">
                    <div class="item">
                        <div class="icon">
                            <i class="uil uil-home"></i>
                        </div>
                        <div class="title">
                            Tong quan
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon">
                            <i class="uil uil-bill"></i>
                        </div>
                        <div class="title">
                            Lich su mua hang
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon">
                           <i class="uil uil-sign-out-alt"></i>
                        </div>
                        <div class="title">
                            Dang xuat
                        </div>
                    </div>
                </div>
                <div class="content">
                    content
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
@endpush
