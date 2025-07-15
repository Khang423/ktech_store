@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Seri sản phẩm
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
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a class="btn btn-success mb-2"
                                href="{{ route('admin.brands.modelSeries.index', $brand->slug) }}">
                                <i class="uil uil-step-backward-alt"></i>
                                Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form method="post" id="form-store" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Seri </label>
                                            <input type="text" class="form-control" id="name" placeholder="Tên seri"
                                                name="name" required>
                                            <div class="text-danger mt-1 error-name"></div>
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
            // init
            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore = '{{ route('admin.brands.modelSeries.store', $brand->slug) }}';
            $routeIndex = '{{ route('admin.brands.modelSeries.index', $brand->slug) }}';
            // function handle
            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);

        });
    </script>
@endpush
