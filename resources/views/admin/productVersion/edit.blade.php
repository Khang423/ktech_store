@php
    use App\Enums\ProductTypeEnum;
    $laptopSpecs = get_laptop_specs($laptopSpec);
    $phoneSpecs = get_phone_specs($phoneSpec);
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
        Cập nhật
    </div>
@endsection
@section('content')
    <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-update">
        @csrf
        @method('PUT')
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
                                                placeholder="Tên sản phẩm" name="name"
                                                value="{{ $productVersions->name }}" readonly>
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="config_name" class="form-label">Tên phiên bản</label>
                                            <input type="text" class="form-control" id="config_name"
                                                placeholder="Tên sản phẩm" name="config_name"
                                                value="{{ $productVersions->config_name }}" readonly>
                                            <div class="text-danger mt-1 error-config_name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="category_product_id" class="form-label">Loại sản phẩm</label>
                                            <input class="form-control" id="category_product_id" name="category_product_id"
                                                value="{{ $products->category_product_id == $category_product->id ? $category_product->name : '' }}"
                                                style="height: 48px" readonly>
                                            <div class="text-danger mt-1 error-category_product_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="brand_id" class="form-label">Thương hiệu </label>
                                            <input class="form-control" id="brand_id" name="brand_id"
                                                value="{{ $products->brand_id == $brand->id ? $brand->name : '' }}"
                                                style="height: 48px" readonly>
                                            <div class="text-danger mt-1 error-brand_id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="model_seri" class="form-label">
                                                Series Sản phẩm
                                            </label>
                                            <input class="form-control" id="model_seri" name="model_seri"
                                                value="{{ $products->model_series_id == $model_seri->id ? $model_seri->name : '' }}"
                                                style="height: 48px" readonly>
                                            <div class="text-danger mt-1 error-model_seri"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="import_price" class="form-label">Giá nhập</label>
                                            <input type="text" class="form-control" id="import_price"
                                                placeholder="Giá nhập" name="import_price"
                                                value="{{ formatPriceToVND($stock_import_detail->price ?? '0') }} " readonly>
                                            <div class="text-danger mt-1 error-import_price"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="profit_rate" class="form-label">Lợi nhuận (%)</label>
                                            <input type="text" class="form-control" id="profit_rate"
                                                placeholder="Lợi nhuận (%)" name="profit_rate"
                                                value="{{ $productVersions->profit_rate }}">
                                            <div class="text-danger mt-1 error-profit_rate"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="final_price" class="form-label">Giá bán</label>
                                            <input type="text" class="form-control" id="final_price"
                                                placeholder="Giá bán" name="final_price"
                                                value="{{ formatPriceToVND($productVersions->final_price) }}">
                                            <div class="text-danger mt-1 error-final_price"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($category_product->slug == ProductTypeEnum::LAPTOP)
                    <div class="laptop">
                        {{--                    cpu and gpu --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="custom-styles-preview">
                                        <h4 class="header-title mb-3">Bộ xử lý và Đồ hoạ</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="gpu" class="form-label">Card Đồ hoạ</label>
                                                    <input type="text" hidden name="product_type" value="laptop">
                                                    <input type="text" class="form-control" id="gpu"
                                                        placeholder="Card Đồ hoạ" name="gpu"
                                                        value="{{ $laptopSpecs['gpu'] }}">
                                                    <div class="text-danger mt-1 error-gpu"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="cpu" class="form-label">CPU</label>
                                                    <input type="text" class="form-control" id="cpu"
                                                        placeholder="CPU" name="cpu"
                                                        value="{{ $laptopSpecs['cpu'] }}">
                                                    <div class="text-danger mt-1 error-cpu"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                Memory and Storage --}}
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
                                                        placeholder="Dung lượng ram" name="ram_size"
                                                        value="{{ $laptopSpecs['ram_size'] }}">
                                                    <div class="text-danger mt-1 error-ram_size"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="ram_type" class="form-label">Loại RAM</label>
                                                    <input type="text" class="form-control" id="ram_type"
                                                        placeholder="Loại RAM" name="ram_type"
                                                        value="{{ $laptopSpecs['ram_type'] }}">
                                                    <div class="text-danger mt-1 error-ram_type"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="ram_slot" class="form-label">Số khe RAM</label>
                                                    <input type="text" class="form-control" id="ram_slot"
                                                        placeholder="Số khe RAM" name="ram_slot"
                                                        value="{{ $laptopSpecs['ram_slot'] }}">
                                                    <div class="text-danger mt-1 error-ram_slot"></div>
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="storage_size" class="form-label">Dung lượng bộ
                                                        nhớ</label>
                                                    <input type="text" class="form-control" id="storage_size"
                                                        placeholder="Dung lượng bộ nhớ" name="storage_size"
                                                        value="{{ $laptopSpecs['storage_size'] }}">
                                                    <div class="text-danger mt-1 error-storage_size"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="storage_type" class="form-label">Loại bộ nhớ</label>
                                                    <input type="text" class="form-control" id="storage_type"
                                                        placeholder="Loại bộ nhớ" name="storage_type"
                                                        value="{{ $laptopSpecs['storage_type'] }}">
                                                    <div class="text-danger mt-1 error-storage_type"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                Display --}}
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
                                                        placeholder="Tần số quét" name="refresh_rate"
                                                        value="{{ $laptopSpecs['refresh_rate'] }}">
                                                    <div class="text-danger mt-1 error-refresh_rate"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="display_panel" class="form-label">Chất liệu tấm
                                                        nền</label>
                                                    <input type="text" class="form-control" id="display_panel"
                                                        placeholder="Chất liệu tấm nền" name="display_panel"
                                                        value="{{ $laptopSpecs['display_panel'] }}">
                                                    <div class="text-danger mt-1 error-display_panel"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="display_size" class="form-label">Kích thước màn
                                                        hình</label>
                                                    <input type="text" class="form-control" id="display_size"
                                                        placeholder="Kích thước màn hình" name="display_size"
                                                        value="{{ $laptopSpecs['display_size'] }}">
                                                    <div class="text-danger mt-1 error-display_size"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="display_technology" class="form-label">Công nghệ màn
                                                        hình</label>
                                                    <input type="text" class="form-control" id="display_technology"
                                                        placeholder="Công nghệ màn hình" name="display_technology"
                                                        value="{{ $laptopSpecs['display_technology'] }}">
                                                    <div class="text-danger mt-1 error-display_technology"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="display_resolution" class="form-label">Độ phân giải
                                                        màn
                                                        hình</label>
                                                    <input type="text" class="form-control" id="display_resolution"
                                                        placeholder="Độ phân giải màn hình" name="display_resolution"
                                                        value="{{ $laptopSpecs['display_resolution'] }}">
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
                                                        placeholder="Công nghệ âm thanh" name="audio_technology"
                                                        value="{{ $laptopSpecs['audio_technology'] }}">
                                                    <div class="text-danger mt-1 error-audio_technology"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="battery" class="form-label">Dung lượng pin</label>
                                                    <input type="text" class="form-control" id="battery"
                                                        placeholder="Dung lượng pin" name="battery"
                                                        value="{{ $laptopSpecs['battery'] }}">
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
                                                        placeholder="Chất liệu" name="material"
                                                        value="{{ $laptopSpecs['material'] }}">
                                                    <div class="text-danger mt-1 error-material"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="weight" class="form-label">Trọng lượng</label>
                                                    <input type="text" class="form-control" id="weight"
                                                        placeholder="Trọng lượng" name="weight"
                                                        value="{{ $laptopSpecs['weight'] }}">
                                                    <div class="text-danger mt-1 error-weight"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="dimensions" class="form-label">Kích thước</label>
                                                    <input type="text" class="form-control" id="dimension"
                                                        placeholder="Kích thước" name="dimension"
                                                        value="{{ $laptopSpecs['dimension'] }}">
                                                    <div class="text-danger mt-1 error-dimension"></div>
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
                                                        placeholder="Bảo mật" name="security"
                                                        value="{{ $laptopSpecs['security'] }}">
                                                    <div class="text-danger mt-1 error-security"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="operating_system" class="form-label">Hệ điều
                                                        hành</label>
                                                    <input type="text" class="form-control" id="operating_system"
                                                        placeholder="Hệ điều hành" name="operating_system"
                                                        value="{{ $laptopSpecs['operating_system'] }}">
                                                    <div class="text-danger mt-1 error-operating_system"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="keyboard_type" class="form-label">Loại bàn phím </label>
                                                    <input type="text" class="form-control" id="keyboard_type"
                                                        placeholder="Loại bàn phím " name="keyboard_type"
                                                        value="{{ $laptopSpecs['keyboard_type'] }}">
                                                    <div class="text-danger mt-1 error-keyboard_type"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="wifi" class="form-label">Wifi</label>
                                                    <input type="text" class="form-control" id="wifi"
                                                        placeholder="Wifi" name="wifi"
                                                        value="{{ $laptopSpecs['wifi'] }}">
                                                    <div class="text-danger mt-1 error-wifi"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="memory_card_slot" class="form-label">Khe cắm thẻ
                                                        nhớ</label>
                                                    <input type="text" class="form-control" id="memory_card_slot"
                                                        placeholder="Khe cắm thẻ nhớ" name="memory_card_slot"
                                                        value="{{ $laptopSpecs['memory_card_slot'] }}">
                                                    <div class="text-danger mt-1 error-memory_card_slot"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="webcam" class="form-label">Camera</label>
                                                    <input type="text" class="form-control" id="webcam"
                                                        placeholder="Camera" name="webcam"
                                                        value="{{ $laptopSpecs['webcam'] }}">
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
                                                        placeholder="Công kết nối" name="usb_ports"
                                                        value="{{ $laptopSpecs['usb_ports'] }}">
                                                    <div class="text-danger mt-1 error-usb_ports"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="release_date" class="form-label">Ngày phát
                                                        hành</label>
                                                    <input type="text" class="form-control" id="release_date"
                                                        placeholder="Ngày phát hành" name="release_date"
                                                        value="{{ $laptopSpecs['release_date'] }}">
                                                    <div class="text-danger mt-1 error-release_date"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="bluetooth_version" class="form-label">Bluetooth</label>
                                                    <input type="text" class="form-control" id="bluetooth_version"
                                                        placeholder="Bluetooth" name="bluetooth_version"
                                                        value="{{ $laptopSpecs['bluetooth_version'] }}">
                                                    <div class="text-danger mt-1 error-bluetooth_version"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($category_product->slug == ProductTypeEnum::PHONE)
                    _phone
                    <div class="phone">
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
                                                    <input type="text" hidden name="product_type" value="phone">
                                                    <input type="text" class="form-control" id="display_size"
                                                        placeholder="Kích thước màn hình" name="display_size"
                                                        value="{{ $phoneSpecs['display_size'] }}">
                                                    <div class="text-danger mt-1 error-display_size"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="display_type" class="form-label">Loại màn hình</label>
                                                    <input type="text" class="form-control" id="display_type"
                                                        placeholder="Loại màn hình" name="display_type"
                                                        value="{{ $phoneSpecs['display_type'] }}">
                                                    <div class="text-danger mt-1 error-display_type"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="display_resolution" class="form-label">Độ phân giải
                                                        màn hình</label>
                                                    <input type="text" class="form-control" id="display_resolution"
                                                        placeholder="Độ phân giải màn hình" name="display_resolution"
                                                        value="{{ $phoneSpecs['display_resolution'] }}">
                                                    <div class="text-danger mt-1 error-display_resolution"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="display_refresh_rate" class="form-label">Tần số
                                                        quét</label>
                                                    <input type="text" class="form-control" id="display_refresh_rate"
                                                        placeholder="Tần số quét" name="display_refresh_rate"
                                                        value="{{ $phoneSpecs['display_refresh_rate'] }}">
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
                                                        placeholder="Tính năng màn hình" name="display_features"
                                                        value="{{ $phoneSpecs['display_features'] }}">
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
                                        {{ $phoneSpecs['rear_camera'] }}
                                    </textarea>
                                                    <div class="text-danger mt-1 error-rear_camera"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="front_camera" class="form-label">Camera Trước</label>
                                                    <input type="text" class="form-control" id="front_camera"
                                                        placeholder="Camera Trước" name="front_camera"
                                                        value="{{ $phoneSpecs['front_camera'] }}">
                                                    <div class="text-danger mt-1 error-front_camera"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="camera_features" class="form-label">Tính năng
                                                        camera</label>
                                                    <textarea class="form-control" id="camera_features" name="camera_features" rows="3">
                                        {{ $phoneSpecs['camera_features'] }}
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
                                                        placeholder="Chipset" name="chipset"
                                                        value="{{ $phoneSpecs['chipset'] }}">
                                                    <div class="text-danger mt-1 error-chipset"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="gpu" class="form-label">Chip Đồ hoạ</label>
                                                    <input type="text" class="form-control" id="gpu"
                                                        placeholder="Đồ hoạ" name="gpu"
                                                        value="{{ $phoneSpecs['gpu'] }}">
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
                                                        placeholder="Công nghệ NFC" name="nfc_support"
                                                        value="{{ $phoneSpecs['nfc_support'] }}">
                                                    <div class="text-danger mt-1 error-nfc_support"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="sim_type" class="form-label">Thẻ sim</label>
                                                    <input type="text" class="form-control" id="sim_type"
                                                        placeholder="Thẻ sim" name="sim_type"
                                                        value="{{ $phoneSpecs['sim_type'] }}">
                                                    <div class="text-danger mt-1 error-sim_type"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="network_support" class="form-label">Hỗ trợ mạng</label>
                                                    <input type="text" class="form-control" id="network_support"
                                                        placeholder="Hỗ trợ mạng" name="network_support"
                                                        value="{{ $phoneSpecs['network_support'] }}">
                                                    <div class="text-danger mt-1 error-network_support"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="gps_support" class="form-label">GPS</label>
                                                    <input type="text" class="form-control" id="gps_support"
                                                        placeholder="GPS" name="gps_support"
                                                        value="{{ $phoneSpecs['gps_support'] }}">
                                                    <div class="text-danger mt-1 error-gps_support"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ram and storage --}}
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
                                                        placeholder="Dung lượng Ram" name="ram_size"
                                                        value="{{ $phoneSpecs['ram_size'] }}">
                                                    <div class="text-danger mt-1 error-ram_size"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="storage_size" class="form-label">Bộ nhớ
                                                        trong</label>
                                                    <input type="text" class="form-control" id="storage_size"
                                                        placeholder="Bộ nhớ trong" name="storage_size"
                                                        value="{{ $phoneSpecs['storage_size'] }}">
                                                    <div class="text-danger mt-1 error-storage_size"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- battery and technology capacity --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="custom-styles-preview">
                                        <h4 class="header-title mb-3">Pin và công nghệ sạc</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="battery_capacity" class="form-label">Dung lượng
                                                        pin</label>
                                                    <input type="text" class="form-control" id="battery_capacity"
                                                        placeholder="Dung lượng pin" name="battery_capacity"
                                                        value="{{ $phoneSpecs['battery_capacity'] }}">
                                                    <div class="text-danger mt-1 error-battery_capacity"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="charging_port" class="form-label">Cổng sạc</label>
                                                    <input type="text" class="form-control" id="charging_port"
                                                        placeholder="Cổng sạc" name="charging_port"
                                                        value="{{ $phoneSpecs['charging_port'] }}">
                                                    <div class="text-danger mt-1 error-charging_port"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="charging_technology" class="form-label">Công nghệ
                                                        sạc</label>
                                                    <textarea class="form-control" name="charging_technology" id="charging_technology" rows="5">
                                        {!! $phoneSpecs['charging_technology'] !!}
                                    </textarea>
                                                    <div class="text-danger mt-1 error-charging_technology"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- weight and dimension --}}
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
                                                        placeholder="Trọng lượng" name="weight"
                                                        value="{{ $phoneSpecs['weight'] }}">
                                                    <div class="text-danger mt-1 error-weight"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="frame_material" class="form-label">Chất liệu khung
                                                        viền</label>
                                                    <input type="text" class="form-control" id="frame_material"
                                                        placeholder="Chất liệu khung viền" name="frame_material"
                                                        value="{{ $phoneSpecs['frame_material'] }}">
                                                    <div class="text-danger mt-1 error-frame_material"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="dimension" class="form-label">Kích thước</label>
                                                    <input type="text" class="form-control" id="dimension"
                                                        placeholder="Kích thước" name="dimension"
                                                        value="{{ $phoneSpecs['dimension'] }}">
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
                                                        placeholder="Hệ điều hành" name="operating_system"
                                                        value="{{ $phoneSpecs['operating_system'] }}">
                                                    <div class="text-danger mt-1 error-operating_system"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="water_dust_resistance" class="form-label">Chỉ số kháng
                                                        bụi,nước</label>
                                                    <input type="text" class="form-control" id="water_dust_resistance"
                                                        placeholder="Chỉ số kháng bụi,nước" name="water_dust_resistance"
                                                        value="{{ $phoneSpecs['water_dust_resistance'] }}">
                                                    <div class="text-danger mt-1 error-water_dust_resistance"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="audio_technology" class="form-label">Công nghệ âm
                                                        thanh</label>
                                                    <input type="text" class="form-control" id="audio_technology"
                                                        placeholder="Công nghệ âm thanh" name="audio_technology"
                                                        value="{{ $phoneSpecs['audio_technology'] }}">
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
                                                        placeholder="Cảm biến vân tay" name="fingerprint_sensor"
                                                        value="{{ $phoneSpecs['fingerprint_sensor'] }}">
                                                    <div class="text-danger mt-1 error-fingerprint_sensor"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="other_sensors" class="form-label">Cảm biến khác</label>
                                                    <input type="text" class="form-control" id="other_sensors"
                                                        placeholder="Cảm biến khác" name="other_sensors"
                                                        value="{{ $phoneSpecs['other_sensors'] }}">
                                                    <div class="text-danger mt-1 error-other_sensors"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="release_date" class="form-label">Ngày phát hành</label>
                                                    <input type="text" class="form-control" id="release_date"
                                                        placeholder="Ngày phát hành" name="release_date"
                                                        value="{{ $phoneSpecs['release_date'] }}">
                                                    <div class="text-danger mt-1 error-release_date"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="wifi_technology" class="form-label">Wifi</label>
                                                    <input type="text" class="form-control" id="wifi_technology"
                                                        placeholder="Wifi" name="wifi_technology"
                                                        value="{{ $phoneSpecs['wifi_technology'] }}">
                                                    <div class="text-danger mt-1 error-wifi_technology"></div>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="bluetooth_technology" class="form-label">Bluetooth</label>
                                                    <input type="text" class="form-control" id="bluetooth_technology"
                                                        placeholder="Bluetooth" name="bluetooth_technology"
                                                        value="{{ $phoneSpecs['bluetooth_technology'] }}">
                                                    <div class="text-danger mt-1 error-bluetooth_technology"></div>
                                                </div>
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
                                    <button class="btn btn-primary" id="btn-update" onclick="tinymce.triggerSave()">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <span>Cập nhật</span>
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
    $(document).ready(() => {
        // Khởi tạo biến form và input
        const $form = $('#form-update');
        const $inputs = $form.find('input');

        // Route dùng để update và quay về danh sách
        const routeUpdate = "{{ route('admin.products.productsVersion.update', ['products' => $products, 'product_version' => $productVersions]) }}";
        const routeIndex = "{{ route('admin.products.productsVersion.index', $products->slug) }}";

        // Gán sự kiện thay đổi brand => gọi load model series
        $('#brand_id').on('change', (e) => {
            const brandId = $(e.target).val();
            loadModelSeries(brandId);
        });

        // Gọi tự động khi trang load nếu có brand sẵn (edit page)
        initSelectOnLoad('#brand_id', loadModelSeries);

        // Gán sự kiện thay đổi category => gọi load usage type
        $('#category_product_id').on('change', (e) => {
            const categoryId = $(e.target).val();
            loadUsageType(categoryId);
        });

        // Gọi tự động khi trang load nếu có category sẵn (edit page)
        initSelectOnLoad('#category_product_id', loadUsageType);

        // Gọi hàm cập nhật và xoá thông báo lỗi
        update(routeUpdate, routeIndex);
        deleteAlertValidation($inputs);
    });

    /**
     * Hàm tự động gọi hàm callback nếu select đã có sẵn giá trị
     * @param {string} selector - ID của thẻ select
     * @param {function} callback - Hàm xử lý tương ứng
     */
    const initSelectOnLoad = (selector, callback) => {
        const value = $(selector).val();
        if (value) {
            callback(value);
        }
    };

    /**
     * Load danh sách usage type dựa theo category_product_id
     * @param {number|string} categoryId
     */
    const loadUsageType = (categoryId) => {
        if (!categoryId) return;

        $.ajax({
            url: `{{ route('admin.products.getDataUsageType') }}`,
            type: "POST",
            dataType: "json",
            data: {
                category_product_id: categoryId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: (response) => {
                const data = response.data || [];
                const $usageTypeSelect = $('#usage_type_id');
                $usageTypeSelect.empty();

                data.forEach(item => {
                    const selected = "{{ $products->usage_type_id }}" == item.id ? 'selected' : '';
                    $usageTypeSelect.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
                });

                $usageTypeSelect.trigger('change');
            },
            error: (err) => {
                console.error("Lỗi khi load usage type:", err);
            },
        });
    };

    /**
     * Load danh sách model series dựa theo brand_id
     * @param {number|string} brandId
     */
    const loadModelSeries = (brandId) => {
        if (!brandId) return;

        $.ajax({
            url: `{{ route('admin.products.getDataModelSeries') }}`,
            type: "POST",
            dataType: "json",
            data: {
                brand_id: brandId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: (response) => {
                const data = response.data || [];
                const $modelSeriesSelect = $("#model_series_id");
                $modelSeriesSelect.empty();

                data.forEach(item => {
                    const selected = "{{ $products->model_series_id }}" == item.id ? "selected" : "";
                    $modelSeriesSelect.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
                });

                $modelSeriesSelect.trigger("change");
            },
            error: (error) => {
                console.error("Lỗi khi load model series:", error);
            },
        });
    };
</script>

@endpush
