@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Trình chiếu slide
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{ route('admin.banners.index') }}">Danh sách</a>
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Thêm
    </div>
@endsection
@section('content')
    <form action="{{ route('admin.banners.store') }}" method="post" enctype="multipart/form-data" autocomplete="off"
        id="form-store">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tiêu đề của Ảnh</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Tên nhà cung cấp" name="name">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="banner_url" class="form-label">Link ảnh</label>
                                            <input type="text" class="form-control" id="banner_url"
                                                placeholder="Url của ảnh" name="banner_url">
                                            <div class="text-danger mt-1 error-banner_url"></div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-store" type="button">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Thêm</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <label class="text-dark header-title font-16 fw-bold">
                            Thumbnail
                        </label>
                        <div class="d-flex justify-content-center mb-2 mt-2">
                            <div id="preview-thumbnail"></div>
                        </div>
                        <input name="banner_image" type="file" id="img_thumbnail" style="display: none" />
                        <div class="thumbnail text-center dropzone">
                            <i class="h1 text-muted uil-upload-alt"></i>
                            <h3>Chose Image</h3>
                        </div>
                        <div class="error-thumbnail text-center text-danger"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('css')
    <link href="{{ asset('css/libraries/select2/custom_select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/libraries/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script>
        $(document).ready(function() {
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
            // init
            const $form = $('#form-store');
            const $inputs = $form.find('input');
            const routeStore = '{{ route('admin.banners.store') }}';
            const routeIndex = '{{ route('admin.banners.index') }}';
            // function handle

            store(routeStore, routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
