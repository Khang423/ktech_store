@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <div class="breadcrumb1">
        <div class="container">
            <a href="{{ route('home.index') }}">
                <span style="color: #2a52be">
                    Trang chủ
                </span>
            </a>
            <i class=" uil-angle-right-b"></i>
            <span style="color: #2a52be">
                Đặt hàng
            </span>
            <i class=" uil-angle-right-b"></i>
            <span class="text-dark">
                Thông tin
            </span>
        </div>
    </div>

    <section class="section-order">
        <div class="main">
            <div class="page-title">
                <div class="info">
                    Thông tin đặt hàng
                </div>
            </div>
            <div class="product-list">
            </div>
            <div class="title">
                Thông tin khách hàng
            </div>
            <form id="form-store" method="post">
                @csrf
                <div class="customer-info">
                    <div class="title-name-and-tel">
                        <div class="name">
                            {{ $customer->name }}
                        </div>
                        <div class="tel">
                            {{ $customer->tel }}
                        </div>
                    </div>
                    <div class="email">
                        <label for="email ">Email</label>
                        <input type="text" name="email_receiver" id="email_receiver" placeholder="NguyenVanA@gmail.com"
                            value="{{ $customer->email }}">
                        <div class="text-danger mt-1 error-email_receiver"></div>
                    </div>
                </div>
                <div class="title mt-3 mb-2">
                    Thông tin nhận hàng
                </div>
                <div class="address-receiver">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ tên</label>
                                <input type="text" class="name form-control" id="name" name="name"
                                    value="{{ $customer->name }}">
                                <div class="text-danger mt-1 error-name"></div>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Tỉnh/thành phố </label>
                                <select class="city form-control select2" data-toggle="select2" id="city"
                                    name="city" required>
                                    <option></option>
                                    @foreach ($city as $i)
                                        <option value={{ $i->id }}>{{ $i->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger mt-1 error-city"></div>
                            </div>
                            <div class="mb-3">
                                <label for="ward" class="form-label">Xã/phường/thị trấn
                                </label>
                                <select class="ward form-control select2" data-toggle="select2" id="ward"
                                    name="ward" required>
                                </select>
                                <div class="text-danger mt-1 error-ward"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="tel" class="form-label">SĐT</label>
                                <input type="text" class="tel form-control" id="tel" name="tel"
                                    value="{{ $customer->tel }}">
                                <div class="text-danger mt-1 error-tel"></div>
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Quận/huyện
                                </label>
                                <select class="district form-control select2" data-toggle="select2" id="district"
                                    name="district" required>
                                </select>
                                <div class="text-danger mt-1 error-district"></div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label for="note" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" id="note" name="note">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="bottom-bar">
                <div class="temporary-price fw-bold">
                    Tổng : <span class="total-price ps-1"></span>
                </div>
                <div class="btn-buy">
                    <div class="content" id="btn-order-now">
                        <span id="count-buy"> Đặt ngay </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/outside/order.js') }}"></script>
    <script>
        const RouteGetDistrict = "{{ route('address.getDistricts') }}";
        const RouteGetWard = "{{ route('address.getWards') }}";
        const RouteOrderStore = "{{ route('home.orderStore') }}";
        const RouteOrder = "{{ route('home.order') }}";
    </script>
@endpush
