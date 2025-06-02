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
            Đặt hàng
        </span>
        <i class=" uil-angle-right-b"></i>
        <span class="text-primary">
            Điền thông tin
        </span>
    </div>
    <hr>
    <section class="section-order">
        <div class="main">
            <div class="page-title">
                <div class="info">
                    1.Thông Tin
                </div>
                <div class="payment">
                    2.Thanh toán
                </div>
            </div>
            <div class="product-list">
                <div class="item">
                    <div class="thumbnail">
                        ádfas
                    </div>
                    <div class="product-info">
                        <div class="name">
                            dsafasdf
                        </div>
                        <div class="price">
                            122435234
                        </div>
                    </div>
                    <div class="product-quantity">
                        Số lượng : 1
                    </div>
                </div>
            </div>
            <div class="customer-info">

            </div>
            <div class="address-receiver">

            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/outside/order.js') }}"></script>
    <script></script>
@endpush

