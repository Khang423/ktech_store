@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
        Gắn vai trò
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{ route('admin.roles.index') }}">Danh sách</a>
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Cập nhật
    </div>
@endsection
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form action="{{ route('admin.roles.update', $role) }}"
                                enctype="multipart/form-data" autocomplete="off"
                                id="form-update">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="role_id" class="form-label">Vai trò</label>
                                            <input type="text" class="form-control" id="role_id" placeholder="role_id"
                                                name="role_id" value="{{ $role->id }}" hidden readonly>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                name="name" value="{{ $role->name }}" readonly>
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-lg-12">
                                        <label for="member_id" class="form-label"> Thành viên </label>
                                        <select class="form-select" id="member_id" name="member_id" style="height: 48px">
                                            <option value="" hidden>Chọn thành viên</option>
                                            @foreach ($member as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger mt-1 error-member_id"></div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-store">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Cập nhật</span>
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
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/libraries/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // init
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            $routeUpdate = '{{ route('admin.roles.update',$role->slug) }}';
            $routeIndex = '{{ route('admin.roles.index') }}';
            // function handle
            update($routeUpdate,$routeIndex);
            deleteAlertValidation($inputs);
            });
    </script>
@endpush
