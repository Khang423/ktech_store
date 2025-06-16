@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Phiếu nhập
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            Danh sách
        </span>
        <i class="mdi mdi-chevron-right"></i>
            Chi tiết phiếu nhập
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
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="product_version_id" class="form-label">Sản phẩm</label>
                                            <select class="form-select" id="product_version_id" name="product_version_id"
                                                style="height: 48px">
                                                <option value="" hidden>Chọn sản phẩm</option>
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-product_version_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="quantity">Số lượng sản phẩm</label>
                                            <input type="text" class="form-control" id="quantity"
                                                placeholder="Số lượng sản phẩm" name="quantity">
                                            <div class="text-danger mt-1 error-quantity"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Đơn giá</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="price"
                                                    placeholder="Đơn giá" name="price">
                                            </div>
                                            <div class="text-danger mt-1 error-price"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mb-2" id="btn-add-product"
                                    onclick="addProductToTable()">
                                    <i class="mdi mdi-plus-circle "></i>
                                </button>
                                <div class="mb-3">
                                    <label class="form-label" for="price">Sản phẩm đã chọn</label>
                                    <table class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product_list">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end">Tổng cộng:</td>
                                                <td id="total_price">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
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
                                <button class="btn btn-primary" id="btn-store">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Nhập</span>
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
        // init
        const $form = $('#form-store');
        const $inputs = $form.find('input');
        $routeStore = '{{ route('admin.stockImports.store') }}';
        $routeIndex = '{{ route('admin.stockImports.index') }}';
        // function handle
        storeInventory($routeStore, $routeIndex);
        deleteAlertValidation($inputs);
    </script>
@endpush
