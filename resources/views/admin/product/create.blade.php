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
        Thêm
    </div>
@endsection
@section('content')
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data" autocomplete="off"
        id="form-store">
        @csrf
        <div class="row">
            <div class="col-8">
                {{-- Information --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Tên sản phẩm" name="name">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="brand_id" class="form-label">Thương hiệu </label>
                                            <select class="form-select" id="brand_id" name="brand_id" style="height: 48px">
                                                <option value="" hidden>Chọn thương hiệu</option>
                                                @foreach ($brand as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-brand_id"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="model_series_id" class="form-label">Seri sản phẩm </label>
                                            <select class="form-select" id="model_series_id" name="model_series_id"
                                                style="height: 48px">
                                            </select>
                                            <div class="text-danger mt-1 error-model_series_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="category_product_id" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="category_product_id" name="category_product_id"
                                                style="height: 48px">
                                                <option value="" hidden>Chọn loại sản phẩm</option>
                                                @foreach ($category_product as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-category_product_id"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="usage_type_id" class="form-label">Nhu cầu sử dụng </label>
                                            <select class="form-select" id="usage_type_id" name="usage_type_id"
                                                style="height: 48px">
                                            </select>
                                            <div class="text-danger mt-1 error-usage_type_id"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Mô tả sản phẩm</h4>
                                <textarea class="form-control tinymce-editor" name="description" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                </div> --}}
=======
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
                                                <option value="laptop">Laptop</option>
                                                <option value="phone">Điện thoại</option>
                                                <option value="keyboard">Bàn phím</option>
                                                <option value="mouse">Chuột </option>
                                                <option value="headphone">Tai nghe </option>
                                            </select>
                                            <div class="text-danger mt-1 error-product_type"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
>>>>>>> bf80720 (update db and feat usagetype status:done)
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <label class="text-dark header-title font-16 fw-bold">
                            Ảnh trưng bày
                        </label>
                        <div class="d-flex justify-content-center mb-2 mt-2">
                            <div id="preview-thumbnail"></div>
                        </div>
                        <input name="thumbnail" type="file" id="img_thumbnail" style="display: none" />
                        <div class="thumbnail text-center dropzone">
                            <i class="h1 text-muted uil-upload-alt"></i>
                            <h3>Chọn ảnh </h3>
                        </div>
                        <div class="error-thumbnail text-center text-danger"></div>
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
                                <button class="btn btn-primary" id="btn-store" onclick="tinymce.triggerSave()">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Thêm</span>
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
            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore = '{{ route('admin.products.store') }}';
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

            $('#category_product_id').change((e) => {
                let categoryid = $(e.target).val();

                $.ajax({
                    url: `{{ route('admin.products.getDataUsageType') }}`,
                    type: "POST",
                    dataType: "json",
                    data: {
                        category_product_id: categoryid,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        const data = response.data;
                        const usage_type = $('#usage_type_id');
                        usage_type.empty();
                        data.forEach((item) => {
                            usage_type.append(
                                `<option value="${item.id}">${item.name}</option>`
                            );
                        });
                        usage_type.trigger('change');
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });

            });

            $('#brand_id').change((e) => {
                let brand_id = $(e.target).val();

                $.ajax({
                    url: `{{ route('admin.products.getDataModelSeries') }}`,
                    type: "POST",
                    dataType: "json",
                    data: {
                        brand_id : brand_id,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        const data = response.data;
                        const usage_type = $('#model_series_id');
                        usage_type.empty();
                        data.forEach((item) => {
                            usage_type.append(
                                `<option value="${item.id}">${item.name}</option>`
                            );
                        });
                        usage_type.trigger('change');
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });

            });

            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
