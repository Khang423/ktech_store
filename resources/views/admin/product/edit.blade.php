@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Sản phẩm
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{ route('admin.products.index') }}">Danh sách</a>
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
            <div class="col-8">
                {{-- Information --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Tên sản phẩm" name="name"
                                                value="{{ $productVersion->name }}">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="supplier_id" class="form-label">Nhà cung cấp</label>
                                            <select class="form-select" id="supplier_id" name="supplier_id"
                                                style="height: 48px">
                                                @foreach ($supplier as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($product->supplier_id == $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-supplier_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="price" class="form-label">Đơn Giá</label>
                                            <input type="text" class="form-control" id="price"
                                                placeholder="Số điện thoại" name="price"
                                                value="{{ $productVersion->price }}">
                                            <div class="text-danger mt-1 error-price"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="category_product_id" class="form-label">Danh mục sản phẩm</label>
                                            <select class="form-select" id="category_product_id" name="category_product_id"
                                                style="height: 48px">
                                                @foreach ($category_product as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($product->category_product_id == $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-category_product_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="brand_id" class="form-label">Thương hiệu </label>
                                            <select class="form-select" id="brand_id" name="brand_id" style="height: 48px">
                                                @foreach ($brand as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($product->brand_id == $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-brand_id"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                // Description --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Mô tả sản phẩm</h4>
                                <textarea class="form-control tinymce-editor" name="description" rows="10">
                                    {{ $productVersion->description }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Chọn loại sản phẩm</h4>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-2">
                                            <select class="form-select" id="product_type" name="product_type"
                                                style="height: 48px">
                                                <option value="null" hidden>Chọn loại sản phẩm</option>
                                                <option value="laptop">Máy tính xách tay</option>
                                                <option value="phone">Điện thoại</option>
                                                <option value="keyboard">Bàn phím</option>
                                                <option value="mouse">Chuột </option>
                                                <option value="headphone">Tai nghe </option>
                                                {{-- @foreach ($supplier as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach --}}

                                            </select>
                                            <div class="text-danger mt-1 error-product_type"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="laptop d-none">
                    {{--                    cpu and gpu --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Bộ xử lý và Đồ hoạ</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="gpu_laptop" class="form-label">Card Đồ hoạ</label>
                                                <input type="text" class="form-control" id="gpu_laptop"
                                                    placeholder="Card Đồ hoạ" name="gpu_laptop">
                                                <div class="text-danger mt-1 error-gpu_laptop"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="cpu" class="form-label">CPU</label>
                                                <input type="text" class="form-control" id="cpu"
                                                    placeholder="CPU" name="cpu">
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
                                                <label for="ram_size_laptop" class="form-label">Dung lượng RAM</label>
                                                <input type="text" class="form-control" id="ram_size_laptop"
                                                    placeholder="Dung lượng ram" name="ram_size_laptop">
                                                <div class="text-danger mt-1 error-ram_size_laptop"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="ram_type" class="form-label">Loại RAM</label>
                                                <input type="text" class="form-control" id="ram_type"
                                                    placeholder="Loại RAM" name="ram_type">
                                                <div class="text-danger mt-1 error-ram_type"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="ram_type" class="form-label">Số khe RAM</label>
                                                <input type="text" class="form-control" id="ram_type"
                                                    placeholder="Số khe RAM" name="ram_type">
                                                <div class="text-danger mt-1 error-ram_type"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="storage_size_laptop" class="form-label">Dung lượng bộ
                                                    nhớ</label>
                                                <input type="text" class="form-control" id="storage_size_laptop"
                                                    placeholder="Dung lượng bộ nhớ" name="storage_size_laptop">
                                                <div class="text-danger mt-1 error-storage_size_laptop"></div>
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
                                                <label for="display_size_laptop" class="form-label">Kích thước màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_size_laptop"
                                                    placeholder="Kích thước màn hình" name="display_size_laptop">
                                                <div class="text-danger mt-1 error-display_size_laptop"></div>
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
                                                <label for="display_resolution_laptop" class="form-label">Độ phân giải màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_resolution_laptop"
                                                    placeholder="Độ phân giải màn hình" name="display_resolution_laptop">
                                                <div class="text-danger mt-1 error-display_resolution_laptop"></div>
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
                                                <label for="audio_technology_laptop" class="form-label">Công nghệ âm
                                                    thanh</label>
                                                <input type="text" class="form-control" id="audio_technology_laptop"
                                                    placeholder="Công nghệ âm thanh" name="audio_technology_laptop">
                                                <div class="text-danger mt-1 error-audio_technology_laptop"></div>
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
                                                <label for="weight_laptop" class="form-label">Trọng lượng</label>
                                                <input type="text" class="form-control" id="weight_laptop"
                                                    placeholder="Trọng lượng" name="weight_laptop">
                                                <div class="text-danger mt-1 error-weight_laptop"></div>
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
                                                <label for="operating_system_laptop" class="form-label">Hệ điều
                                                    hành</label>
                                                <input type="text" class="form-control" id="operating_system_laptop"
                                                    placeholder="Hệ điều hành" name="operating_system_laptop">
                                                <div class="text-danger mt-1 error-operating_system_laptop"></div>
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
                                                <label for="wifi_laptop" class="form-label">Wifi</label>
                                                <input type="text" class="form-control" id="wifi_laptop"
                                                    placeholder="Wifi" name="wifi_laptop">
                                                <div class="text-danger mt-1 error-wifi_laptop"></div>
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
                </div>
                <div class="phone d-none">
                    {{-- display --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="custom-styles-preview">
                                    <h4 class="header-title mb-3">Màn hình</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_size_phone" class="form-label">Kích thước màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_size_phone"
                                                    placeholder="Kích thước màn hình" name="display_size_phone"
                                                    value="{{ $phone->display_size }}">
                                                <div class="text-danger mt-1 error-display_size_phone"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_type" class="form-label">Loại màn hình</label>
                                                <input type="text" class="form-control" id="display_type"
                                                    placeholder="Loại màn hình" name="display_type"
                                                    value="{{ $phone->display_type }}">
                                                <div class="text-danger mt-1 error-display_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_resolution_phone" class="form-label">Độ phân giải màn
                                                    hình</label>
                                                <input type="text" class="form-control" id="display_resolution_phone"
                                                    placeholder="Độ phân giải màn hình" name="display_resolution_phone"
                                                    value="{{ $phone->display_resolution }}">
                                                <div class="text-danger mt-1 error-display_resolution_phone"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="display_refresh_rate" class="form-label">Tần số quét</label>
                                                <input type="text" class="form-control" id="display_refresh_rate"
                                                    placeholder="Tần số quét" name="display_refresh_rate"
                                                    value="{{ $phone->display_refresh_rate }}">
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
                                                    value="{{ $phone->display_features }}">
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
                            <div class="tab-content
                                <div class="tab-pane show active"
                                id="custom-styles-preview">
                                <h4 class="header-title mb-3">Camera</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="rear_camera" class="form-label">Camera Sau</label>
                                            <textarea class="form-control" id="rear_camera" name="rear_camera" rows="3">
                                                  {{$phone->rear_camera }}
                                                </textarea>
                                            <div class="text-danger mt-1 error-rear_camera"></div>
                                        </div>

                                        <div class="mb-2">
                                            <label for="front_camera" class="form-label">Camera Trước</label>
                                            <input type="text" class="form-control" id="front_camera"
                                                placeholder="Camera Trước" name="front_camera"
                                                value="{{ $phone->front_camera }}">
                                            <div class="text-danger mt-1 error-front_camera"></div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="camera_features" class="form-label">Tính năng camera</label>
                                            <textarea class="form-control" id="camera_features" name="camera_features" rows="3">
                                                     {{ $phone->camera_features }}
                                                </textarea>
                                            <div class="text-danger mt-1 error-camera_features"></div>
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
                                                    placeholder="Chipset" name="chipset" value="{{ $phone->chipset }}">
                                                <div class="text-danger mt-1 error-chipset"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="gpu_phone" class="form-label">Chip Đồ hoạ</label>
                                                <input type="text" class="form-control" id="gpu_phone"
                                                    placeholder="Đồ hoạ" name="gpu_phone" value="{{ $phone->gpu }}">
                                                <div class="text-danger mt-1 error-gpu_phone"></div>
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
                                                    value="{{ $phone->nfc_support }}">
                                                <div class="text-danger mt-1 error-nfc_support"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="sim_type" class="form-label">Thẻ sim</label>
                                                <input type="text" class="form-control" id="sim_type"
                                                    placeholder="Thẻ sim" name="sim_type"
                                                    value="{{ $phone->sim_type }}">
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
                                                    value="{{ $phone->network_support }}">
                                                <div class="text-danger mt-1 error-network_support"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="gps_support" class="form-label">GPS</label>
                                                <input type="text" class="form-control" id="gps_support"
                                                    placeholder="GPS" name="gps_support"
                                                    value="{{ $phone->gps_support }}">
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
                                                <label for="ram_size_phone" class="form-label">Dung lượng Ram</label>
                                                <input type="text" class="form-control" id="ram_size_phone"
                                                    placeholder="Dung lượng Ram" name="ram_size_phone"
                                                    value="{{ $phone->ram_size }}">
                                                <div class="text-danger mt-1 error-ram_size_phone"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="storage_size_phone" class="form-label">Bộ nhớ trong</label>
                                                <input type="text" class="form-control" id="storage_size_phone"
                                                    placeholder="Bộ nhớ trong" name="storage_size_phone"
                                                    value="{{ $phone->storage_size }}">
                                                <div class="text-danger mt-1 error-storage_size_phone"></div>
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
                                                    placeholder="Dung lượng pin" name="battery_capacity"
                                                    value="{{ $phone->battery_capacity }}">
                                                <div class="text-danger mt-1 error-battery_capacity"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="charging_port" class="form-label">Cổng sạc</label>
                                                <input type="text" class="form-control" id="charging_port"
                                                    placeholder="Cổng sạc" name="charging_port"
                                                    value="{{ $phone->charging_port }}">
                                                <div class="text-danger mt-1 error-charging_port"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="charging_technology" class="form-label">Công nghệ sạc</label>
                                                <textarea class="form-control" name="charging_technology" id="charging_technology" rows="5">
                                                     {!! $phone->charging_technology !!}
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
                                                <label for="weight_phone" class="form-label">Trọng lượng</label>
                                                <input type="text" class="form-control" id="weight_phone"
                                                    placeholder="Trọng lượng" name="weight_phone"
                                                    value="{{ $phone->weight }}">
                                                <div class="text-danger mt-1 error-weight_phone"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="frame_material" class="form-label">Chất liệu khung
                                                    viền</label>
                                                <input type="text" class="form-control" id="frame_material"
                                                    placeholder="Chất liệu khung viền" name="frame_material"
                                                    value="{{ $phone->frame_material }}">
                                                <div class="text-danger mt-1 error-frame_material"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="dimension" class="form-label">Kích thước</label>
                                                <input type="text" class="form-control" id="dimension"
                                                    placeholder="Kích thước" name="dimension"
                                                    value="{{ $phone->dimension }}">
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
                                                <label for="operating_system_phone" class="form-label">Hệ điều
                                                    hành</label>
                                                <input type="text" class="form-control" id="operating_system_phone"
                                                    placeholder="Hệ điều hành" name="operating_system_phone"
                                                    value="{{ $phone->operating_system }}">
                                                <div class="text-danger mt-1 error-operating_system_phone"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="water_dust_resistance" class="form-label">Chỉ số kháng
                                                    bụi,nước</label>
                                                <input type="text" class="form-control" id="water_dust_resistance"
                                                    placeholder="Chỉ số kháng bụi,nước" name="water_dust_resistance"
                                                    value="{{ $phone->water_dust_resistance }}">
                                                <div class="text-danger mt-1 error-water_dust_resistance"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="audio_technology_phone" class="form-label">Công nghệ âm
                                                    thanh</label>
                                                <input type="text" class="form-control" id="audio_technology_phone"
                                                    placeholder="Công nghệ âm thanh" name="audio_technology_phone"
                                                    value="{{ $phone->audio_technology }}">
                                                <div class="text-danger mt-1 error-audio_technology_phone"></div>
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
                                                    value="{{ $phone->fingerprint_sensor }}">
                                                <div class="text-danger mt-1 error-fingerprint_sensor"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="other_sensors" class="form-label">Cảm biến khác</label>
                                                <input type="text" class="form-control" id="other_sensors"
                                                    placeholder="Cảm biến khác" name="other_sensors"
                                                    value="{{ $phone->other_sensors }}">
                                                <div class="text-danger mt-1 error-other_sensors"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="release_date" class="form-label">Ngày phát hành</label>
                                                <input type="text" class="form-control" id="release_date"
                                                    placeholder="Ngày phát hành" name="release_date_phone"
                                                    value="{{ $phone->release_date }}">
                                                <div class="text-danger mt-1 error-release_date"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="wifi_technology" class="form-label">Wifi</label>
                                                <input type="text" class="form-control" id="wifi_technology"
                                                    placeholder="Wifi" name="wifi_technology"
                                                    value="{{ $phone->wifi_technology }}">
                                                <div class="text-danger mt-1 error-wifi_technology"></div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="bluetooth_technology" class="form-label">Bluetooth</label>
                                                <input type="text" class="form-control" id="bluetooth_technology"
                                                    placeholder="Bluetooth" name="bluetooth_technology"
                                                    value="{{ $phone->bluetooth_technology }}">
                                                <div class="text-danger mt-1 error-bluetooth_technology"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        @if ($productVersion->thumbnail !== null)
                            <label class="text-dark header-title font-16 fw-bold">
                                Ảnh trưng bày
                            </label>
                            <div class="d-flex justify-content-center mb-2 mt-2">
                                <div id="preview-thumbnail">
                                    <img src="{{ asset('asset/admin/products') . '/' . $productVersion->id . '/' . $productVersion->thumbnail }}"
                                        width="250" height="auto" class="img-fluid img-thumbnail mt-2 mb-2">
                                </div>
                            </div>
                            <input name="thumbnail_old" type="hidden"style="display: none"  value="{{$productVersion->thumbnail}}"/>
                            <input name="thumbnail_new" type="file" id="img_thumbnail" style="display: none" />
                            <div class="thumbnail text-center dropzone">
                                <i class="h1 text-muted uil-upload-alt"></i>
                                <h3>Chọn ảnh </h3>
                            </div>
                            <div class="error-thumbnail text-center text-danger"></div>
                        @else
                            <label class="text-dark header-title font-16 fw-bold">
                                Ảnh trưng bày
                            </label>
                            <div class="d-flex justify-content-center mb-2 mt-2">
                                <div id="preview-thumbnail">
                                </div>
                            </div>
                            <input name="thumbnail" type="file" id="img_thumbnail" style="display: none" />
                            <div class="thumbnail text-center dropzone">
                                <i class="h1 text-muted uil-upload-alt"></i>
                                <h3>Chọn ảnh </h3>
                            </div>
                            <div class="error-thumbnail text-center text-danger"></div>
                        @endif
                    </div>
                </div>
                {{-- //  image detail --}}
                <div class="card">
                    <div class="card-body">
                        <lable class="text-dark header-title font-16 fw-bold">
                            Ảnh chi tiết
                        </lable>
                        <div class="d-flex justify-content-center mb-2 mt-2">
                            <div id="preview-image"></div>
                        </div>
                        <div class="mt-2">
                            <input name="image_add[]" type="file" id="imgInput" style="display: none" multiple>
                            <div class="dz-message-image text-center dropzone">
                                <i class="h1 text-muted uil-upload-alt"></i>
                                <h3>Chọn nhiều ảnh</h3>
                            </div>
                        </div>
                        <div class="error-new-image text-center text-danger"></div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <lable class="text-dark header-title font-16 fw-bold">
                                Ảnh chi tiết cũ
                            </lable>
                            <div class=" mb-2 mt-2">
                                @foreach ($product_image as $index => $image)
                                    <div class="mt-2 text-center image-container">
                                        <i class="destroy-image btn btn-link uil-times-square font-24 text-danger"
                                            data-id="{{ $image->id }}"></i>

                                        <img src="{{ asset('asset/admin/products') . '/' . $image->product_id . '/image/' . $image->image }}"
                                            class="old-img img-fluid img-thumbnail me-3" width="170" height="auto">

                                        <input type="file" name="image_update[{{ $index }}]" class="mt-2">

                                        <input type="hidden" name="product_id[{{ $index }}]"
                                            value="{{ $image->product_id }}" readonly>
                                        <input type="hidden" name="product_image_old_id[{{ $index }}]"
                                            value="{{ $image->id }}" readonly>
                                        <input type="hidden" name="image_old[{{ $index }}]"
                                            value="{{ $image->image }}" readonly>
                                    </div>
                                    <div class="error-img text-center text-danger mt-2"
                                        id="error-img-{{ $image->id }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
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
    </form>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // init
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            $routeUpdate = '{{ route('admin.products.update', $productVersion->slug) }}';
            $routeIndex = '{{ route('admin.products.index') }}';

            $(".thumbnail").on("click", function() {
                $("#img_thumbnail").click();
            });

            $("#img_thumbnail").change(function() {
                let preview_thumbnail = $("#preview-thumbnail");
                preview_thumbnail.empty();
                let fileList = Array.from(this.files).map(file => {
                    let img = $("<img class='img-fluid img-thumbnail' width='250' height='auto'>")
                        .attr("src", URL.createObjectURL(file));
                    img.on("load", function() {
                        URL.revokeObjectURL(img.attr("src"));
                    });

                    let sizeText = $("<div class='text-center text-dark'>" + formatBytes(file
                        .size) + "</div>");
                    return $("<div class='d-inline-block text-center'></div>").append(img,
                        sizeText);
                });
                preview_thumbnail.append(fileList);
            });

            $(".dz-message-image").on("click", function() {
                $("#imgInput").click();
            });

            $("#imgInput").change(function() {
                let preview_image = $("#preview-image");
                preview_image.empty();

                let fileList = Array.from(this.files).map(file => {
                    let img = $(
                            "<img class='img-fluid img-thumbnail me-3' width='170' height='auto'>")
                        .attr("src", URL.createObjectURL(file));
                    img.on("load", function() {
                        URL.revokeObjectURL(img.attr("src"));
                    });

                    let sizeText = $("<div class='text-center text-dark'>" + formatBytes(file
                        .size) + "</div>");
                    return $("<div class='d-inline-block text-center'></div>").append(img,
                        sizeText);
                });

                preview_image.append(fileList);
            });

            $('.destroy-image').click(function () {
                let button = $(this).parent();
                let error_image = $(this).data('id');

                let image = $(this).siblings('input[name^="image_old["]').val();
                let product_id = $(this).siblings('input[name^="product_id["]').val();
                let id = $(this).siblings('input[name^="product_image_id["]').val();

                $.ajax({
                    url: '{{ route('admin.products.destroy-image') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        product_id: product_id,
                        image: image,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        $(this).next('.old-img').hide();
                        button.remove();
                    },
                    error: function (data) {
                        $.each(data.responseJSON.errors, function (key, value) {
                            // console.log(key + ': ' + value);
                            $('#error-img' + error_image).text(value);
                        });
                    }
                });
            });

            $('#product_type').change(function() {
                let optionValue = $(this).val();

                // Ẩn hết tất cả các phần liên quan

                // Hiện phần phù hợp
                if (optionValue === 'laptop') {
                    $('.laptop').removeClass('d-none');
                    $('.phone').addClass('d-none');
                } else if (optionValue === 'phone') {
                    $('.phone').removeClass('d-none');
                    $('.laptop').addClass('d-none');
                } else {
                    $('.laptop').addClass('d-none');
                    $('.phone').addClass('d-none');
                }
            });
            // function handle post data
            update($routeUpdate, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
