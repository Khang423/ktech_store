@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh mục: {{ $categoryProduct->name }}
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            Danh sách
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
                                <div class="row" hidden>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="catogory_product_id" class="form-label">Danh mục sản phẩm</label>
                                            <select class="form-select" id="catogory_product_id" name="catogory_product_id"
                                                style="height: 48px">
                                                <option value="{{ $categoryProduct->id }}">
                                                    {{ $categoryProduct->name }}
                                                </option>
                                            </select>
                                            <div class="text-danger mt-1 error-catogory_product_id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên danh mục chi tiết</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Tên danh mục chi tiết" name="name">
                                                <div class="text-danger mt-1 error-name"></div>
                                            </div>
                                        </div>
                                    </div>
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
            $routeStore =
                "{{ route('admin.categoryProducts.details.store', ['categoryProduct' => $slug]) }}";
            $routeIndex = "{{ route('admin.categoryProducts.detail', ['categoryProduct' => $slug]) }}";
            // function handle
            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
