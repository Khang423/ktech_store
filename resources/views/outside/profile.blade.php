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
            <span class="text-dark">
                Tài khoản cá nhân
            </span>
        </div>
    </div>
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
                            {{ $customer->name }}
                        </div>
                        <div class="tel">
                            {{ $customer->tel }}
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
                            {{ $order_count }}
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
                            {{ formatPriceToVND($total_price) }}
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
                        <div class="item btn-action-logout">
                            <div class="icon">
                                <i class="uil uil-sign-out-alt"></i>
                            </div>
                            <div class="title">
                                Đăng xuất
                            </div>
                        </div>

                    </div>
                    <div class="content ">
                        <div class="purchase-history d-none">
                            <div class="order-status">
                                <div class="item active all" id="order-all">
                                    Tất cả
                                </div>
                                <div class="item pending" id="status-pending">
                                    Chờ xác nhận
                                </div>
                                <div class="item processing" id="status-1">
                                    Đang xử lý
                                </div>
                                <div class="item shiped" id="status-2">
                                    Đang vận chuyển
                                </div>
                                <div class="item delivered" id="status-3">
                                    Đã giao hàng
                                </div>
                                <div class="item cancel" id="status-4">
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
                                @foreach ($order as $i)
                                    <div class="item mb-2">
                                        <div class="item-header">
                                            <div class="left">
                                                <div class="id-order">
                                                    Đơn hàng : {{ $i->order_code ?? '' }}
                                                </div>
                                                <div class="order-date">
                                                    Ngày đặt hàng : {{ $i->created_at }}
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="order-status cancel">
                                                    @if ($i->status === 1)
                                                        <span class="text-info badge bg-light font-15">Chờ xác nhận</span>
                                                    @elseif ($i->status === 2)
                                                        <span class="text-success badge bg-light font-15">Đãng xử lý</span>
                                                    @elseif ($i->status === 3)
                                                        <span class="text-primary badge bg-light font-15">Đang giao</span>
                                                    @elseif ($i->status === 4)
                                                        <span class="text-success badge bg-light font-15">Đã giao </span>
                                                    @elseif ($i->status === 5)
                                                        <span class="text-danger badge bg-light font-15">Đã huỷ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-content mt-1">
                                            <div class="left">
                                                <div class="thumbnail">
                                                    <img src="{{ asset('asset/admin/products') . '/' . $i->orderItem->first()->productVersions->product_id . '/' . $i->orderItem->first()->productVersions->products->thumbnail }}"
                                                        alt="">
                                                </div>
                                                <div class="product-info">
                                                    <div class="name">
                                                        {{ $i->orderItem->first()->productVersions->config_name }}
                                                    </div>
                                                    <div class="price">
                                                        {{ formatPriceToVND($i->orderItem->first()->productVersions->final_price) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="order-total">
                                                    Tổng thanh toán : <span
                                                        style="font-size: 16px;font-weight: 600;color: #25449a">{{ formatPriceToVND($i->total_price) }}</span>
                                                </div>
                                                <div class="order-detail">
                                                    Xem chi tiết >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="account-info " id="profile-account-info">
                            <div class="personal-info">
                                <div class="info-header">
                                    <div class="left">
                                        <div class="title">
                                            Thông tin cá nhân
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="btn-info-update">
                                            <i class="uil uil-edit"></i> Cập nhật
                                        </div>
                                    </div>
                                </div>
                                <form id="form-info" method="POST">
                                    @csrf
                                    <div class="info-content">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="item">
                                                    <div class="mb-1 col-12">
                                                        <label for="name" class="form-label">Họ tên</label>
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="Họ tên" name="name"
                                                            value="{{ $customer->name }}">
                                                        <div class="text-danger mt-1 error-name"></div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="mb-1 col-12">
                                                        <label for="gender" class="form-label">Giới tính</label>
                                                        <select class="form-select" id="gender" name="gender"
                                                            style="height: 48px">
                                                            <option value="{{ $customer->gender }}" hidden>
                                                                @if ($customer->gender == '0')
                                                                    Nam
                                                                @elseif ($customer->gender == '1')
                                                                    Nữ
                                                                @else
                                                                    Khác
                                                                @endif
                                                            </option>
                                                            <option value="0">Nam</option>
                                                            <option value="1">Nữ</option>
                                                            <option value="2">Khác</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="mb-1 col-12">
                                                        <label for="birthday" class="form-label">Ngày sinh</label>
                                                        <input type="text" class="form-control" id="birthday"
                                                            placeholder="Ngày sinh" name="birthday"
                                                            value="{{ $customer->birthday }}">
                                                        <div class="text-danger mt-1 error-birthday"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="item">
                                                    <div class="mb-1 col-12">
                                                        <label for="tel" class="form-label">Số điện thoại</label>
                                                        <input type="text" class="form-control" id="tel"
                                                            placeholder="Số điện thoại" name="tel"
                                                            value="{{ $customer->tel }}">
                                                        <div class="text-danger mt-1 error-tel"></div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="mb-3 col-12">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="Email" name="email"
                                                            value="{{ $customer->email }}">
                                                        <div class="text-danger mt-1 error-email"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="address-info">
                                <div class="address-header">
                                    <div class="title">
                                        Thông tin địa chỉ
                                    </div>
                                    <div class="btn-add-address" id="btn-address-update">
                                        <i class="uil uil-edit"></i> Cập nhật
                                    </div>
                                </div>
                                <form id="form-address" method="POST">
                                    @csrf
                                    <div class="address-content">
                                        <div class="mb-1 col-12">
                                            <label for="city" class="form-label">Tỉnh/thành phố </label>
                                            <select class="city form-control select2" data-toggle="select2"
                                                id="city" name="city" required>
                                                <option></option>
                                                @foreach ($city as $i)
                                                    <option value="{{ $i->id }}"
                                                        {{ $customer->city_id == $i->id ? 'selected' : '' }}>
                                                        {{ $i->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-city"></div>
                                        </div>
                                        <div class="mb-1 col-12">
                                            <label for="district" class="form-label">Quận/huyện
                                            </label>
                                            <select class="district form-control select2" data-toggle="select2"
                                                id="district" name="district" required>
                                            </select>
                                            <div class="text-danger mt-1 error-district"></div>
                                        </div>
                                        <div class="mb-1 col-12">
                                            <label for="ward" class="form-label">Xã/phường/thị trấn
                                            </label>
                                            <select class="ward form-control select2" data-toggle="select2"
                                                id="ward" name="ward" required>
                                            </select>
                                            <div class="text-danger mt-1 error-ward"></div>
                                        </div>
                                        <div class="mb-1 col-12">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>

                                    </div>
                                </form>
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
            <div class="modal-logout d-none  ">
                <div class="modal-logout-overlay">
                    <div class="modal-logout-content">
                        <span class="modal-logout-close"><i class="uil-multiply"></i></span>
                        <div class="logo">
                            <img src="{{ asset('asset/admin/systemImage/ktech-dark.svg') }}" alt="Logo Ktech">
                        </div>
                        <div class="text-review">
                            Bạn chắc chắn muốn đăng xuất
                        </div>
                        <div class="btn-action">
                            <div class="btn-cancel">
                                Huỷ
                            </div>
                            <div class="btn-logout">
                                Tiếp tục
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/outside/profile.js') }}"></script>
    <script>
        const RouteGetDistrict = "{{ route('address.getDistricts') }}";
        const RouteGetWard = "{{ route('address.getWards') }}";
        const RouteAddAddress = "{{ route('home.addAddress') }}";
        const RouteDeleteAddress = "{{ route('home.deleteAddress') }}";
        const RouteProfile = "{{ route('home.profile') }}";
        const RouteLogout = "{{ route('home.logout') }}";
        const RouteGetDataOrderByStatus = "{{ route('home.getDataOrder') }}";
        const RouteInfoUpdate = "{{ route('home.infoUpdate') }}";
        const RouteAddressUpdate = "{{ route('home.addressUpdate') }}";
    </script>
@endpush
