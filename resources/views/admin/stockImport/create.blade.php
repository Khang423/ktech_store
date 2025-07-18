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
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="category_product_id" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="category_product_id" name="category_product_id"
                                                style="height: 48px">
                                                <option value="" hidden>Chọn loại sản phẩm</option>
                                                @foreach ($category_product as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-category_product_id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="products" class="form-label">Sản phẩm</label>
                                            <select class="form-select" id="products" name="products" style="height: 48px">
                                            </select>
                                            <div class="text-danger mt-1 error-products"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="product_version" class="form-label">Phiên bản sản phẩm</label>
                                            <select class="form-select" id="product_version" name="product_version"
                                                style="height: 48px">
                                            </select>
                                            <div class="text-danger mt-1 error-product_version"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="supplier_id" class="form-label">Nhà cung cấp</label>
                                            <select class="form-select" id="supplier_id" name="supplier_id"
                                                style="height: 48px">
                                                <option value="" hidden>Chọn nhà cung cấp</option>
                                                @foreach ($suppliers as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-supplier_id"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="quantity">Số lượng sản phẩm</label>
                                            <input type="text" class="form-control" id="quantity"
                                                placeholder="Số lượng sản phẩm" name="quantity">
                                            <div class="text-danger mt-1 error-quantity"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Giá nhập (VNĐ)</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="price"
                                                    placeholder="Giá nhập" name="price">
                                            </div>
                                            <div class="text-danger mt-1 error-price"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="vat" class="form-label">Thuế VAT (%)</label>
                                            <input type="text" class="form-control" id="vat"
                                                placeholder="Thuế VAT (%)" name="vat">
                                            <div class="text-danger mt-1 error-vat"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mb-2" id="btn-add-product"
                                    onclick="addProductToTable()">
                                    <i class="mdi mdi-plus-circle "></i>
                                </button>
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <div class="title text-uppercase text-center mb-2 fs-4 fw-medium">
                                            Danh sách sản phẩm nhập
                                        </div>
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Tên sản phẩm</th>
                                                    <th class="text-center">Số lượng</th>
                                                    <th class="text-center">Giá nhập</th>
                                                    <th class="text-center">VAT</th>
                                                    <th class="text-center">Giá nhập + VAT</th>
                                                    <th class="text-center">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_list">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-end">Tổng cộng:</td>
                                                    <td class="text-center" id="total_price">0</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-store">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Nhập kho</span>
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
    <script src="{{ asset('js/admin/inventories.js') }}"></script>
    <script>
        $(document).ready(() => {
            // init
            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore = '{{ route('admin.stockImports.store') }}';
            $routeIndex = '{{ route('admin.inventories.index') }}';

            $('#category_product_id').change((e) => {
                let categoryid = $(e.target).val();

                $.ajax({
                    url: `{{ route('admin.stockImports.getDataProduct') }}`,
                    type: "POST",
                    dataType: "json",
                    data: {
                        category_product_id: categoryid,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        const data = response.data;
                        const products = $('#products');
                        products.empty();
                        data.forEach((item) => {
                            products.append(
                                `<option value="${item.id}">${item.name}</option>`
                            );
                        });
                        products.trigger('change');
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });


            $('#products').change((e) => {
                let product_id = $(e.target).val();

                $.ajax({
                    url: `{{ route('admin.stockImports.getDataProductVersion') }}`,
                    type: "POST",
                    dataType: "json",
                    data: {
                        product_id: product_id,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        const data = response.data;
                        const product_version = $('#product_version');
                        product_version.empty();
                        data.forEach((item) => {
                            product_version.append(
                                `<option value="${item.id}">${item.config_name}</option>`
                            );
                        });
                        product_version.trigger('change');
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });
            // function handle
            storeInventory($routeStore, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
