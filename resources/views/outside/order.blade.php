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
                        <input type="text" name="email_receiver" id="email_receiver" placeholder="Email"
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
                                <label for="name" class="form-label">Họ tên người nhận</label>
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
                                        @if ($customer->city_id == $i->id)
                                            <option value="{{ $i->id }}" selected>{{ $i->name }}
                                            </option>
                                        @else
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="text-danger mt-1 error-city"></div>
                            </div>
                            <div class="mb-3">
                                <label for="ward" class="form-label">Xã/phường/thị trấn
                                </label>
                                @if ($customer->ward_id)
                                    <select class="ward form-control select2" data-toggle="select2" id="ward"
                                        name="ward" required>
                                        <option value="{{ $customer->wards->id }}">
                                            {{ $customer->wards->name }}
                                        </option>
                                    </select>
                                @else
                                    <select class="ward form-control select2" data-toggle="select2" id="ward"
                                        name="ward" required>
                                    </select>
                                @endif
                                <div class="text-danger mt-1 error-ward"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="tel" class="form-label">SĐT người nhận </label>
                                <input type="text" class="tel form-control" id="tel" name="tel"
                                    value="{{ $customer->tel }}">
                                <div class="text-danger mt-1 error-tel"></div>
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Quận/huyện
                                </label>
                                @if ($customer->district_id)
                                    <select class="district form-control select2" data-toggle="select2" id="district"
                                        name="district" required>
                                        <option value="{{ $customer->districts->id }}">
                                            {{ $customer->districts->name }}
                                        </option>
                                    </select>
                                @else
                                    <select class="district form-control select2" data-toggle="select2" id="district"
                                        name="district" required>
                                    </select>
                                @endif
                                <div class="text-danger mt-1 error-district"></div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                @if ($customer->note)
                                    <input type="text" class="form-control" id="note" name="note"
                                        value="{{ $customer->note }}">
                                @else
                                    <input type="text" class="form-control" id="note" name="note">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- bar --}}
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
            <div class="title mt-3 mb-2">
                Phương thức thanh toán
            </div>
            <div class="method-payment selected" id="btn-select-method">
                <div class="method-icon">
                    <img src="{{ asset('asset/icon/cod.png') }}" alt="">
                </div>
                <div class="method-name" data-id="0">
                    Thanh toán khi nhận hàng
                </div>
                <div class="other-option">
                    <span>Thay đổi</span><i class="uil uil-angle-right fs-2"></i>
                </div>
            </div>
            <div class="overlay">
                <div class="modal-method d-none">
                    <div class="method-header">
                        <div class="title">
                            Chọn phương thức thanh toán
                        </div>
                        <div class="btn-method-close">
                            <i class="uil uil-multiply"></i>
                        </div>
                    </div>
                    <div class="method-body">
                        <div class="method-payment mb-1 cod" data-id="0" id="">
                            <div class="method-icon">
                                <img src="{{ asset('asset/icon/cod.png') }}" alt="">
                            </div>
                            <div class="method-name">
                                Thanh toán khi nhận hàng
                            </div>
                        </div>
                        <div class="method-payment mb-1 bank_transfer" data-id="2">
                            <div class="method-icon">
                                <img src="{{ asset('asset/icon/qr_code.png') }}" alt="">
                            </div>
                            <div class="method-name">
                                Chuyển khoản ngân hàng qua mã QR
                            </div>
                        </div>
                        <div class="method-payment momo mb-1" data-id="1">
                            <div class="method-icon">
                                <img src="{{ asset('asset/icon/momo.png') }}" alt="">
                            </div>
                            <div class="method-name">
                                Ví MoMo
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title mt-3 mb-2">
                Phí vận chuyển
            </div>
            <div class="payment-content mt-3" id="ship" data-id="1">
                <div class="thumbnail">
                    <img src="{{ asset('asset/icon/viettel_post.png') }}" alt="">
                </div>
                <div class="title">
                    Viettel Post
                </div>
                <div class="fee-ship">
                    {{ formatPriceToVND(30000) }}
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
