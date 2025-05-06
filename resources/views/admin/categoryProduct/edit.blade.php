@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh mục sản phẩm
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{route('admin.suppliers.index') }}">Danh sách</a>
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Cập nhật
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form method="post"
                                  enctype="multipart/form-data"
                                  autocomplete="off"
                                  id="form-store">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên Danh mục</label>
                                            <input type="text" class="form-control" id="name"
                                                   placeholder="Tên Danh mục"
                                                   name="name"
                                                   value="{{ $categoryProduct->name }}">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <input type="text" class="form-control" id="description"
                                                   placeholder="Mô tả"
                                                   name="description"
                                                   value="{{ $categoryProduct->name }}">
                                            <div class="text-danger mt-1 error-description"></div>
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
@endpush
@push('js')

    <script>
        $(document).ready(function () {
            // init
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            $routeUpdate = '{{ route('admin.categoryProducts.update',$categoryProduct->slug) }}';
            $routeIndex = '{{ route('admin.categoryProducts.index') }}';
            // function handle
            update($routeUpdate, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
