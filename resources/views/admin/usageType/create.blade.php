@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Nhu cầu sử dụng
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
                            <form method="post" id="form-store" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên nhu cầu </label>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
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
            $routeStore = '{{ route('admin.categoryProducts.usageTypes.store', $category_product->slug) }}';
            $routeIndex = '{{ route('admin.categoryProducts.usageTypes.index', $category_product->slug) }}';
            // function handle
            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);

        });
    </script>
@endpush
