@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Nhà cung cấp
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{route('admin.suppliers.index') }}">Danh sách</a>
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
                            <form action="{{ route('admin.suppliers.store') }}" method="post"
                                  enctype="multipart/form-data"
                                  autocomplete="off"
                            id="form-store">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên nhà cung cấp</label>
                                            <input type="text" class="form-control" id="name"
                                                   placeholder="Tên nhà cung cấp"
                                                   name="name" >
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone"
                                                   placeholder="Số điện thoại"
                                                   name="phone" >
                                            <div class="text-danger mt-1 error-phone"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="hotline" class="form-label">Số điện thoại hotline</label>
                                            <input type="text" class="form-control" id="hotline"
                                                   placeholder="Số điện thoại hotline"
                                                   name="hotline" >
                                            <div class="text-danger mt-1 error-hotline"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address"
                                                   placeholder="Địa chỉ"
                                                   name="address" >
                                            <div class="text-danger mt-1 error-address"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" class="form-control" id="email"
                                                       placeholder="Email" aria-describedby="inputGroupPrepend" required
                                                       name="email">
                                            </div>
                                            <div class="text-danger mt-1 error-email"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="website" class="form-label">Link website</label>
                                            <input type="text" class="form-control" id="website"
                                                   placeholder="Link website"
                                                   name="website" >
                                            <div class="text-danger mt-1 error-website"></div>
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
    <link href="{{ asset('css/libraries/select2/custom_select2.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/libraries/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endpush
@push('js')

    <script>
        $(document).ready(function () {
            // init
            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore = '{{ route('admin.suppliers.store') }}';
            $routeIndex = '{{ route('admin.suppliers.index') }}';
            // function handle
            store($routeStore,$routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
