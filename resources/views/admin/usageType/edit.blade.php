@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Nhu cầu
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
                            <form enctype="multipart/form-data" autocomplete="off" id="form-update">
                                @csrf
                                @method('PUT')
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                name="name" required value="{{ $usage_type->name }}">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="button" id="btn-update">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <span>Cập nhật</span>
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
            const $form = $('#form-update');
            const $inputs = $form.find('input');
            const routeUpdate =
                "{{ route('admin.categoryProducts.usageTypes.update', ['usageType' => $usage_type->slug, 'categoryProduct' => $category_product->slug]) }}";
            const routeIndex = '{{ route('admin.categoryProducts.usageTypes.index', $category_product->slug) }}';

            // function handle
            update(routeUpdate, routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
