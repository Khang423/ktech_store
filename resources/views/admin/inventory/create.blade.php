@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Kho hàng
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
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product_version_id" class="form-label">Sản phẩm</label>
                                            <select class="form-select" id="product_version_id" name="product_version_id"
                                                style="height: 48px">
                                                <option value="" hidden>Chọn sản phẩm</option>
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-product_version_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="quantity">Số lượng sản phẩm</label>
                                            <input type="text" class="form-control" id="quantity"
                                                placeholder="Số lượng sản phẩm" name="quantity">
                                            <div class="text-danger mt-1 error-quantity"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email" aria-describedby="inputGroupPrepend" name="email">
                                            </div>
                                            <div class="text-danger mt-1 error-email"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Giới tính</label>
                                            <select class="form-select" id="gender" name="gender" style="height: 48px">
                                                <option value="" hidden>Chọn giới tính</option>
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                                <option value="2">Khác</option>

                                            </select>
                                            <div class="text-danger mt-1 error-gender"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control"
                                                    placeholder="Mật khẩu" name="password">
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                            <div class="text-danger mt-1 error-password"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="birthday" class="form-label fw-semibold">Sinh nhật</label>
                                            <input type="text" id="datepicker" name="birthday" class="form-control"
                                                name="Sinh nhật" placeholder="Birthday">
                                            <div class="text-danger mt-1 error-birthday"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ward" class="form-label">Địa chỉ</label>
                                            <div class="input-group">
                                                <textarea class="form-control" placeholder="Địa chỉ" id="address" style="height: 100px" name="address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="avatar">Chọn ảnh đại diện</label>
                                                    <input class="form-control" type="file" id="avatar"
                                                        name="avatar">
                                                    <div class="text-danger mt-1 error-avatar"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <img id="preview-avatar"
                                                        src="{{ asset('asset/admin/systemImage/avatar.png') }}"
                                                        alt="image" class="img-fluid avatar-lg rounded-circle">
                                                </div>
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
@push('js')
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap5'
            });

            $('#avatar').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const previewUrl = URL.createObjectURL(file);
                    $('#preview-avatar').attr('src', previewUrl);
                }
            });
            // init
            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore = '{{ route('admin.members.store') }}';
            $routeIndex = '{{ route('admin.members.index') }}';
            // function handle
            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
