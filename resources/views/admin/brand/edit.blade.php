@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Brands
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            List
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Update
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form action="{{ route('admin.brands.update', $brand->slug) }}"
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mb-3">Information</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                name="name" required value="{{ $brand->name }}">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" class="form-control" id="country" placeholder="Country"
                                                name="country" required value="{{ $brand->country }}">
                                            <div class="text-danger mt-1 error-country"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="website_link" class="form-label">Website URL</label>
                                            <input type="text" class="form-control" id="website_link"
                                                placeholder="Website URL" name="website_link" required
                                                value="{{ $brand->website_link }}">
                                            <div class="text-danger mt-1 error-website_link"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <lable class="text-dark header-title font-16 fw-bold">
                                                    Thumbnail
                                                </lable>
                                                <div class="d-flex justify-content-center mb-2 mt-2">
                                                    <div id="preview-thumbnail">
                                                        <img src="{{ asset('asset/admin/brands') . '/' . $brand->logo }}"
                                                            width="250" height="auto" class="img-fluid  mt-2 mb-2"
                                                            style="border:2px solid gray">
                                                    </div>
                                                </div>
                                                <input name="thumbnail_old" type="hidden" value="{{ $brand->logo }}" id="thumbnail_old"/>
                                                <input name="thumbnail_new" type="file" id="thumbnail_new"
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
                                <div>
                                    <button class="btn btn-primary" type="button" id="btn-update">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <span>Add Brand</span>
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
@push('css')
    <link href="{{ asset('css/libraries/select2/custom_select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/libraries/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/libraries/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            function formatBytes(bytes, decimals = 2) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
            }
            $(".thumbnail").on("click", function() {
                $("#thumbnail_new").click();
            });

            $("#thumbnail_new").change(function() {
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

            $('#btn-update').click(function(e) {
                e.preventDefault();
                let form = $(this).parents('form');
                let form_data = new FormData(form[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function() {
                        window.location.href = '{{ route('admin.brands.index') }}';
                        toast('Update member successfully');
                    },
                    error: function(data) {
                        $('.text-danger').text('');
                        if (data.responseJSON && data.responseJSON.errors) {
                            let errors = data.responseJSON.errors;
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    $(`.error-${field}`).text(errors[field][0]);
                                }
                            }
                        }
                    }
                });
            });

        });
    </script>
@endpush
