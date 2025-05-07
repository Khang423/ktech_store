@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Tài khoản
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
                            <form enctype="multipart/form-data" autocomplete="off" id="form-update">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mb-3">Information</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên</label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ $member->name }}" placeholder="Tên" name="name" required>
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone"
                                                placeholder="Số điện thoại" value="{{ $member->phone }}" name="phone"
                                                required>
                                            <div class="text-danger mt-1 error-phone"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email" aria-describedby="inputGroupPrepend" required
                                                    name="email" value="{{ $member->email }}">
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
                                                <option value="{{ $member->gender }}" hidden>
                                                    @if ($member->gender == '0')
                                                        Nam
                                                    @elseif ($member->gender == '1')
                                                        Nữ
                                                    @else
                                                        Khác
                                                    @endif
                                                </option>
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                                <option value="2">Khác</option>

                                            </select>
                                            <div class="text-danger mt-1 error-gender"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label fw-semibold">Sinh nhật</label>
                                            <input type="text" id="datepicker" class="form-control" name="birthday"
                                                placeholder="Sinh nhật" value="{{ $member->birthday }}">
                                            <div class="text-danger mt-1 error-birthday"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ward" class="form-label">Địa chỉ</label>
                                            <div class="input-group">
                                                <textarea class="form-control" placeholder="Địa chỉ" id="address" style="height: 100px" name="address">
                                                    {!! $member->address !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="avatar">Chọn ảnh đại diện mới</label>
                                                    <input class="form-control" type="hidden" id="avatar"
                                                        name="avatar_old" value="{{ $member->avatar }}">
                                                    <input class="form-control" type="file" id="avatar_new"
                                                        name="avatar_new">
                                                    <div class="text-danger mt-1 error-avatar"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    @if ($member->avatar)
                                                        <img src="{{ asset('asset/admin/members') }}/{{ $member->avatar }}"
                                                            class="img-fluid avatar-lg rounded-circle" alt="image"
                                                            id="preview-avatar">
                                                    @else
                                                        <img id="preview-avatar"
                                                            src="{{ asset('asset/admin/systemImage/avatar.png') }}"
                                                            alt="image" class="img-fluid avatar-lg rounded-circle">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-update">
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
    <link href="{{ asset('css/libraries/select2/custom_select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/libraries/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ asset('js/libraries/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap5'
            });

            $('#avatar_new').on('change', function() {
                const file = event.target.files[0];
                if (file) {
                    const previewUrl = URL.createObjectURL(file);
                    $('#preview-avatar').attr('src', previewUrl);
                }
            });

            // init
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            $routeUpdate = '{{ route('admin.members.update', $member->slug) }}';
            $routeIndex = '{{ route('admin.members.index') }}';
            // function handle
            update($routeUpdate, $routeIndex);
            deleteAlertValidation($inputs);

        });
    </script>
@endpush
