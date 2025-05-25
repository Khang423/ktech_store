@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Vai trò
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
                            <form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data"
                                autocomplete="off"
                                id="form-store">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên vai trò</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                name="name" required>
                                            <div class="text-danger mt-1 error-name"></div>
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
        // init
        const $form = $('#form-store');
        const $inputs = $form.find('input');
        $routeStore = '{{ route('admin.roles.store') }}';
        $routeIndex = '{{ route('admin.roles.index') }}';
        // function handle
        store($routeStore, $routeIndex);
        deleteAlertValidation($inputs);
    </script>
@endpush
