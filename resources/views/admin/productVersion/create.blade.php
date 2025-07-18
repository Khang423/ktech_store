@php
    use App\Enums\ProductTypeEnum;
@endphp
@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            {{ $products->name }}
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            Danh sách phiên bản
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Thêm
    </div>
@endsection
@section('content')
    <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-update">
        @csrf
        <div class="row">
            <div class="col-12">
                {{-- Information --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Tên sản phẩm" name="name" value="{{ $products->name }}">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="category_product_id" class="form-label">Loại sản phẩm</label>
                                            <input class="form-control" id="category_product_id" name="category_product_id"
                                                value="{{ $products->category_product_id == $category_product->id ? $category_product->name : '' }}"
                                                style="height: 48px" disabled>
                                            <div class="text-danger mt-1 error-category_product_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="brand_id" class="form-label">Thương hiệu </label>
                                            <input class="form-control" id="brand_id" name="brand_id"
                                                value="{{ $products->brand_id == $brand->id ? $brand->name : '' }}"
                                                style="height: 48px" disabled>
                                            <div class="text-danger mt-1 error-brand_id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="category_product_detail_id" class="form-label">
                                                Series Sản phẩm
                                            </label>
                                            <input class="form-control" id="model_seri" name="model_seri"
                                                value="{{ $products->model_series_id == $model_seri->id ? $model_seri->name : '' }}"
                                                style="height: 48px" disabled>
                                            <div class="text-danger mt-1 error-model_seri"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($category_product->slug === ProductTypeEnum::LAPTOP)
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Bộ xử lý và Đồ hoạ</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="gpu" class="form-label">Card Đồ hoạ</label>
                                                <input type="text" class="form-control" id="gpu"
                                                    placeholder="Card Đồ hoạ" name="gpu">
                                                <div class="text-danger mt-1 error-gpu"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="cpu" class="form-label">CPU</label>
                                                <input type="text" class="form-control" id="cpu" placeholder="CPU"
                                                    name="cpu">
                                                <div class="text-danger mt-1 error-cpu"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Memory and Storage --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Bộ nhớ ram và ổ cứng</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="ram_size" class="form-label">Dung lượng RAM</label>
                                                <input type="text" class="form-control" id="ram_size"
                                                    placeholder="Dung lượng ram" name="ram_size">
                                                <div class="text-danger mt-1 error-ram_size"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="ram_type" class="form-label">Loại RAM</label>
                                                <input type="text" class="form-control" id="ram_type"
                                                    placeholder="Loại RAM" name="ram_type">
                                                <div class="text-danger mt-1 error-ram_type"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="ram_slot" class="form-label">Số khe RAM</label>
                                                <input type="text" class="form-control" id="ram_slot"
                                                    placeholder="Số khe RAM" name="ram_slot">
                                                <div class="text-danger mt-1 error-ram_slot"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="storage_size" class="form-label">Dung lượng bộ
                                                    nhớ</label>
                                                <input type="text" class="form-control" id="storage_size"
                                                    placeholder="Dung lượng bộ nhớ" name="storage_size">
                                                <div class="text-danger mt-1 error-storage_size"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="storage_type" class="form-label">Loại bộ nhớ</label>
                                                <input type="text" class="form-control" id="storage_type"
                                                    placeholder="Loại bộ nhớ" name="storage_type">
                                                <div class="text-danger mt-1 error-storage_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Display --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Màn hình</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="refresh_rate" class="form-label">Tần số quét</label>
                                                <input type="text" class="form-control" id="refresh_rate"
                                                    placeholder="Tần số quét" name="refresh_rate">
                                                <div class="text-danger mt-1 error-refresh_rate"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="display_panel" class="form-label">Chất liệu tấm nền</label>
                                                <input type="text" class="form-control" id="display_panel"
                                                    placeholder="Chất liệu tấm nền" name="display_panel">
                                                <div class="text-danger mt-1 error-display_panel"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="display_size" class="form-label">Kích thước màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_size"
                                                    placeholder="Kích thước màn hình" name="display_size">
                                                <div class="text-danger mt-1 error-display_size"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="display_technology" class="form-label">Công nghệ màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_technology"
                                                    placeholder="Công nghệ màn hình" name="display_technology">
                                                <div class="text-danger mt-1 error-display_technology"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="display_resolution" class="form-label">Độ phân giải màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_resolution"
                                                    placeholder="Độ phân giải màn hình" name="display_resolution">
                                                <div class="text-danger mt-1 error-display_resolution"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Sound and Batery --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Âm thanh và Pin</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="audio_technology" class="form-label">Công nghệ âm
                                                    thanh</label>
                                                <input type="text" class="form-control" id="audio_technology"
                                                    placeholder="Công nghệ âm thanh" name="audio_technology">
                                                <div class="text-danger mt-1 error-audio_technology"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="battery" class="form-label">Dung lượng pin</label>
                                                <input type="text" class="form-control" id="battery"
                                                    placeholder="Dung lượng pin" name="battery">
                                                <div class="text-danger mt-1 error-battery"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--    dimension and weigth --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Kích thước và trọng luượng</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="material" class="form-label">Chất liệu</label>
                                                <input type="text" class="form-control" id="material"
                                                    placeholder="Chất liệu" name="material">
                                                <div class="text-danger mt-1 error-material"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="weight" class="form-label">Trọng lượng</label>
                                                <input type="text" class="form-control" id="weight"
                                                    placeholder="Trọng lượng" name="weight">
                                                <div class="text-danger mt-1 error-weight"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="dimensions" class="form-label">Kích thước</label>
                                                <input type="text" class="form-control" id="dimensions"
                                                    placeholder="Kích thước" name="dimensions">
                                                <div class="text-danger mt-1 error-dimensions"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--    utilities and other feature --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Tiện ích và tính năng khác</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="security" class="form-label">Bảo mật</label>
                                                <input type="text" class="form-control" id="security"
                                                    placeholder="Bảo mật" name="security">
                                                <div class="text-danger mt-1 error-security"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="operating_system" class="form-label">Hệ điều
                                                    hành</label>
                                                <input type="text" class="form-control" id="operating_system"
                                                    placeholder="Hệ điều hành" name="operating_system">
                                                <div class="text-danger mt-1 error-operating_system"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="keyboard_type" class="form-label">Loại bàn phím </label>
                                                <input type="text" class="form-control" id="keyboard_type"
                                                    placeholder="Loại bàn phím " name="keyboard_type">
                                                <div class="text-danger mt-1 error-keyboard_type"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="wifi" class="form-label">Wifi</label>
                                                <input type="text" class="form-control" id="wifi"
                                                    placeholder="Wifi" name="wifi">
                                                <div class="text-danger mt-1 error-wifi"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="memory_card_slot" class="form-label">Khe cắm thẻ nhớ</label>
                                                <input type="text" class="form-control" id="memory_card_slot"
                                                    placeholder="Khe cắm thẻ nhớ" name="memory_card_slot">
                                                <div class="text-danger mt-1 error-memory_card_slot"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="webcam" class="form-label">Camera</label>
                                                <input type="text" class="form-control" id="webcam"
                                                    placeholder="Camera" name="webcam">
                                                <div class="text-danger mt-1 error-webcam"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--    port connect --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Các cổng kết nối</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="usb_ports" class="form-label">Công kết nối</label>
                                                <input type="text" class="form-control" id="usb_ports"
                                                    placeholder="Công kết nối" name="usb_ports">
                                                <div class="text-danger mt-1 error-usb_ports"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="release_date" class="form-label">Ngày phát hành</label>
                                                <input type="text" class="form-control" id="release_date"
                                                    placeholder="Ngày phát hành" name="release_date">
                                                <div class="text-danger mt-1 error-release_date"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="bluetooth_version" class="form-label">Bluetooth</label>
                                                <input type="text" class="form-control" id="bluetooth_version"
                                                    placeholder="Bluetooth" name="bluetooth_version">
                                                <div class="text-danger mt-1 error-bluetooth_version"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($category_product->slug === ProductTypeEnum::PHONE)
                    {{-- display --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Màn hình</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_size" class="form-label">Kích thước màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_size"
                                                    placeholder="Kích thước màn hình" name="display_size">
                                                <div class="text-danger mt-1 error-display_size"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_type" class="form-label">Loại màn hình</label>
                                                <input type="text" class="form-control" id="display_type"
                                                    placeholder="Loại màn hình" name="display_type">
                                                <div class="text-danger mt-1 error-display_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_resolution" class="form-label">Độ phân giải màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_resolution"
                                                    placeholder="Độ phân giải màn hình" name="display_resolution">
                                                <div class="text-danger mt-1 error-display_resolution"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_refresh_rate" class="form-label">Tần số quét</label>
                                                <input type="text" class="form-control" id="display_refresh_rate"
                                                    placeholder="Tần số quét" name="display_refresh_rate">
                                                <div class="text-danger mt-1 error-display_refresh_rate"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_features" class="form-label">Tính năng màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_features"
                                                    placeholder="Tính năng màn hình" name="display_features">
                                                <div class="text-danger mt-1 error-display_features"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Camera --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Camera</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="rear_camera" class="form-label">Camera Sau</label>
                                                <textarea class="form-control" id="rear_camera" name="rear_camera" rows="3">

                                                </textarea>
                                                <div class="text-danger mt-1 error-rear_camera"></div>
                                            </div>

                                            <div class="mb-2">
                                                <label for="front_camera" class="form-label">Camera Trước</label>
                                                <input type="text" class="form-control" id="front_camera"
                                                    placeholder="Camera Trước" name="front_camera">
                                                <div class="text-danger mt-1 error-front_camera"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="camera_features" class="form-label">Tính năng camera</label>
                                                <textarea class="form-control" id="camera_features" name="camera_features" rows="3">
                                                </textarea>
                                                <div class="text-danger mt-1 error-camera_features"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- chipset --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Vi xử lý và đồ hoạ</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="chipset" class="form-label">Chipset</label>
                                                <input type="text" class="form-control" id="chipset"
                                                    placeholder="Chipset" name="chipset">
                                                <div class="text-danger mt-1 error-chipset"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="gpu" class="form-label">Chip Đồ hoạ</label>
                                                <input type="text" class="form-control" id="gpu"
                                                    placeholder="Đồ hoạ" name="gpu">
                                                <div class="text-danger mt-1 error-gpu"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- comm and connect --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Giao tiếp và kết nối</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="nfc_support" class="form-label">Công nghệ NFC</label>
                                                <input type="text" class="form-control" id="nfc_support"
                                                    placeholder="Công nghệ NFC" name="nfc_support">
                                                <div class="text-danger mt-1 error-nfc_support"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="sim_type" class="form-label">Thẻ sim</label>
                                                <input type="text" class="form-control" id="sim_type"
                                                    placeholder="Thẻ sim" name="sim_type">
                                                <div class="text-danger mt-1 error-sim_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="network_support" class="form-label">Hỗ trợ mạng</label>
                                                <input type="text" class="form-control" id="network_support"
                                                    placeholder="Hỗ trợ mạng" name="network_support">
                                                <div class="text-danger mt-1 error-network_support"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="gps_support" class="form-label">GPS</label>
                                                <input type="text" class="form-control" id="gps_support"
                                                    placeholder="GPS" name="gps_support">
                                                <div class="text-danger mt-1 error-gps_support"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--    ram and storage --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Ram và lưu trữ</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="ram_size" class="form-label">Dung lượng Ram</label>
                                                <input type="text" class="form-control" id="ram_size"
                                                    placeholder="Dung lượng Ram" name="ram_size">
                                                <div class="text-danger mt-1 error-ram_size"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="storage_size" class="form-label">Bộ nhớ trong</label>
                                                <input type="text" class="form-control" id="storage_size"
                                                    placeholder="Bộ nhớ trong" name="storage_size">
                                                <div class="text-danger mt-1 error-storage_size"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- battery and technoly capacity --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Pin và công nghệ sạc</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="battery_capacity" class="form-label">Dung lượng pin</label>
                                                <input type="text" class="form-control" id="battery_capacity"
                                                    placeholder="Dung lượng pin" name="battery_capacity">
                                                <div class="text-danger mt-1 error-battery_capacity"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="charging_port" class="form-label">Cổng sạc</label>
                                                <input type="text" class="form-control" id="charging_port"
                                                    placeholder="Cổng sạc" name="charging_port">
                                                <div class="text-danger mt-1 error-charging_port"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="charging_technology" class="form-label">Công nghệ sạc</label>
                                                <textarea class="form-control" name="charging_technology" id="charging_technology" rows="5">
                                                    </textarea>
                                                <div class="text-danger mt-1 error-charging_technology"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--   weight and dimension --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Kích thước và trọng lượng</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="weight" class="form-label">Trọng lượng</label>
                                                <input type="text" class="form-control" id="weight"
                                                    placeholder="Trọng lượng" name="weight">
                                                <div class="text-danger mt-1 error-weight"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="frame_material" class="form-label">Chất liệu khung
                                                    viền</label>
                                                <input type="text" class="form-control" id="frame_material"
                                                    placeholder="Chất liệu khung viền" name="frame_material">
                                                <div class="text-danger mt-1 error-frame_material"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="dimension" class="form-label">Kích thước</label>
                                                <input type="text" class="form-control" id="dimension"
                                                    placeholder="Kích thước" name="dimension">
                                                <div class="text-danger mt-1 error-dimension"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- other --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Thông số khác</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="operating_system" class="form-label">Hệ điều
                                                    hành</label>
                                                <input type="text" class="form-control" id="operating_system"
                                                    placeholder="Hệ điều hành" name="operating_system">
                                                <div class="text-danger mt-1 error-operating_system"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="water_dust_resistance" class="form-label">Chỉ số kháng
                                                    bụi,nước</label>
                                                <input type="text" class="form-control" id="water_dust_resistance"
                                                    placeholder="Chỉ số kháng bụi,nước" name="water_dust_resistance">
                                                <div class="text-danger mt-1 error-water_dust_resistance"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="audio_technology" class="form-label">Công nghệ âm
                                                    thanh</label>
                                                <input type="text" class="form-control" id="audio_technology"
                                                    placeholder="Công nghệ âm thanh" name="audio_technology">
                                                <div class="text-danger mt-1 error-audio_technology"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- feature other --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Tiện ích khác</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="fingerprint_sensor" class="form-label">Cảm biến vân
                                                    tay</label>
                                                <input type="text" class="form-control" id="fingerprint_sensor"
                                                    placeholder="Cảm biến vân tay" name="fingerprint_sensor">
                                                <div class="text-danger mt-1 error-fingerprint_sensor"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="other_sensors" class="form-label">Cảm biến khác</label>
                                                <input type="text" class="form-control" id="other_sensors"
                                                    placeholder="Cảm biến khác" name="other_sensors">
                                                <div class="text-danger mt-1 error-other_sensors"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="release_date" class="form-label">Ngày phát hành</label>
                                                <input type="text" class="form-control" id="release_date"
                                                    placeholder="Cảm biến khác" name="release_date">
                                                <div class="text-danger mt-1 error-release_date"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="wifi_technology" class="form-label">Wifi</label>
                                                <input type="text" class="form-control" id="wifi_technology"
                                                    placeholder="Wifi" name="wifi_technology">
                                                <div class="text-danger mt-1 error-wifi_technology"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="bluetooth_technology" class="form-label">Bluetooth</label>
                                                <input type="text" class="form-control" id="bluetooth_technology"
                                                    placeholder="Bluetooth" name="bluetooth_technology">
                                                <div class="text-danger mt-1 error-bluetooth_technology"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active">
                                    <button class="btn btn-primary" id="btn-store" onclick="tinymce.triggerSave()">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <span>Thêm </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('css')
@endpush
@push('js')
    <script src="{{ asset('js/admin/product.js') }}"></script>
    <script>
        $(document).ready(function() {
            // khai báo biến
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            const routeStore = "{{ route('admin.products.productsVersion.store', $products->slug) }}";
            const routeIndex = "{{ route('admin.products.productsVersion.index', $products->slug) }}";



            store(routeStore, routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
