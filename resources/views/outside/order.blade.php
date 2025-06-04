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
                @for ($i = 0; $i < 4; $i++)
                    <div class="item">
                        <div class="thumbnail">
                            <img src="{{ asset('asset/admin/products/1/thumbnail_6829439552bbf.webp') }}" alt="">
                        </div>
                        <div class="product-info">
                            <div class="name">
                                OPPO Reno10 Pro Plus 5G 12GB 256GB - Tím
                            </div>
                            <div class="price">
                                {{ formatPriceToVND(36599000) }}
                            </div>
                        </div>
                        <div class="product-quantity">
                            Số lượng : 1
                        </div>
                    </div>
                @endfor
            </div>
            <div class="title">
                Thông tin khách hàng
            </div>
            <div class="customer-info">
                <div class="title-name-and-tel">
                    <div class="name">
                        Vo Vi Khang
                    </div>
                    <div class="tel">
                        0799599040
                    </div>
                </div>
                <div class="email">
                    <label for="email ">Email</label>
                    <input type="text" name="email-receiver" id="email-receiver" value="vovykhag@gmail.com">
                </div>
            </div>
            <div class="title mt-3 mb-2">
                Thông tin nhận hàng
            </div>
            <div class="address-receiver">
                <form action="" id="form-store">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">TÊN NGƯỜI NHẬN</label>
                                <input type="text" class="name form-control" id="name" name="name">
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
                            <div class="mb-3" >
                                <label for="tel" class="form-label">SĐT NGƯỜI NHẬN</label>
                                <input type="text" class="tel form-control" id="tel" name="tel">
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
                                <label for="address" class="form-label">ĐỊA CHỈ</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label for="name" class="form-label">GHI CHÚ</label>
                                <input type="text" class="name form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/outside/order.js') }}"></script>
    <script></script>
@endpush
