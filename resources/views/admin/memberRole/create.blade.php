@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Gán vai trò
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{ route('admin.roles.index') }}">Danh sách</a>
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Thêm
    </div>
@endsection
@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-store">
                                @csrf
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
        // init
        const $form = $('#form-store');
        const $inputs = $form.find('input');
        const routeStore = "{{ route('admin.roles.memberRoles.store', $role) }}";
        const routeIndex = "{{ route('admin.roles.memberRoles.index', $role) }}";
        // function handle
        store(routeStore, routeIndex);
        deleteAlertValidation($inputs);
    </script>
@endpush
