@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Thương hiệu
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
                            <form action="{{ route('admin.brands.store') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên </label>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                name="name" required>
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Quốc gia</label>
                                            <input type="text" class="form-control" id="country" placeholder="Country"
                                                name="country" required>
                                            <div class="text-danger mt-1 error-country"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="website_link" class="form-label">Link website</label>
                                            <input type="text" class="form-control" id="website_link"
                                                placeholder="Website URL" name="website_link" required>
                                            <div class="text-danger mt-1 error-website_link"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <label class="text-dark header-title font-16 fw-bold">
                                                    Ảnh logo
                                                </label>
                                                <div class="d-flex justify-content-center mb-2 mt-2">
                                                    <div id="preview-thumbnail"></div>
                                                </div>
                                                <input name="thumbnail" type="file" id="img_thumbnail"
                                                    style="display: none" />
                                                <div class="thumbnail text-center dropzone">
                                                    <i class="h1 text-muted uil-upload-alt"></i>
                                                    <h3>Chọn ảnh</h3>
                                                </div>
                                                <div class="error-thumbnail text-center text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" id="btn-store">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <span>Thêm</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
            $routeStore = '{{ route('admin.brands.store') }}';
            $routeIndex = '{{ route('admin.brands.index') }}';
            // function handle
            store($routeStore,$routeIndex);
            deleteAlertValidation($inputs);

        });
    </script>
@endpush
