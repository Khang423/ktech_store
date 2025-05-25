@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh mục sản phẩm
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{ route('admin.suppliers.index') }}">Danh sách</a>
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Thêm
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-store">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên Danh mục</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Tên Danh mục" name="name">
                                                <div class="text-danger mt-1 error-name"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Mô tả</label>
                                                <input type="text" class="form-control" id="description"
                                                    placeholder="Mô tả" name="description">
                                                <div class="text-danger mt-1 error-description"></div>
                                            </div>
                                        </div>
                                         <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="product_type" class="form-label">Loại sản phẩm</label>
                                                <select name="product_type" class="form-control"  id="product_type" style="height: 48px">
                                                    <option value="" hidden>Chọn loại sản phẩm</option>
                                                    <option value="0">Laptop</option>
                                                    <option value="1">Điện thoại</option>
                                                    <option value="2">Bàn phím</option>
                                                    <option value="3">Chuột</option>
                                                    <option value="4">Tai nghe</option>
                                                </select>
                                                <div class="text-danger mt-1 error-product_type"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <label class="text-dark header-title font-16 fw-bold">
                                                    Ảnh
                                                </label>
                                                <div class="d-flex justify-content-center mb-2 mt-2">
                                                    <div id="preview-thumbnail"></div>
                                                </div>
                                                <input name="thumbnail" type="file" id="img_thumbnail"
                                                    style="display: none" />
                                                <div class="thumbnail text-center dropzone">
                                                    <i class="h1 text-muted uil-upload-alt"></i>
                                                    <h3>Chose Image</h3>
                                                </div>
                                                <div class="error-thumbnail text-center text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <button class="btn btn-primary" id="btn-store">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Thêm</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // init
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

                    let sizeText = $("<div class='text-center text-dark mt-2'>" + formatBytes(file
                        .size) + "</div>");
                    return $("<div class='d-inline-block text-center'></div>").append(img,
                        sizeText);
                });
                preview_thumbnail.append(fileList);
            });

            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore = '{{ route('admin.categoryProducts.store') }}';
            $routeIndex = '{{ route('admin.categoryProducts.index') }}';
            // function handle
            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
