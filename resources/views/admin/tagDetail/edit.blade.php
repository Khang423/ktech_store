@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh mục : {{ $categoryProductDetail->categoryProduct->name }}
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            Danh sách
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
                            <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-store">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row" hidden>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="catogory_product_id" class="form-label">Danh mục sản phẩm</label>
                                            <select class="form-select" id="catogory_product_id" name="catogory_product_id"
                                                style="height: 48px">
                                                    <option value="{{ $categoryProductDetail->id }}">
                                                        {{ $categoryProductDetail->name }}
                                                    </option>
                                            </select>
                                            <div class="text-danger mt-1 error-catogory_product_id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên danh mục chi tiết</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Tên danh mục chi tiết" name="name" value="{{ $categoryProductDetail->name }}">
                                                <div class="text-danger mt-1 error-name"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-update">
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
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // init
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            $routeUpdate = "{{ route('admin.categoryProducts.details.update', ['categoryProduct' => $categoryProduct, 'categoryProductDetail' => $categoryProductDetail]) }}";
            $routeIndex = "{{ route('admin.categoryProducts.detail', ['categoryProduct' => $categoryProduct]) }}";
            // function handle
            update($routeUpdate, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
