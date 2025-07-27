@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Kho hàng
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Danh sách sản phẩm
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <a class="btn btn-primary mb-2" href="{{ route('admin.stockImports.create') }}">
                                <i class="mdi mdi-plus-circle me-2"></i>
                                Nhập kho
                            </a>
                            <a class="btn btn-primary mb-2" href="{{ route('admin.stockImports.index') }}">
                                <i class="uil uil-history"></i>
                                Lịch sử nhập kho
                            </a>
                            <a class="btn btn-primary mb-2" href="{{ route('admin.stockExports.create') }}">
                                <i class="mdi mdi-plus-circle me-2"></i>
                                Xuất kho
                            </a>
                            <a class="btn btn-primary mb-2" href="{{ route('admin.stockExports.index') }}">
                                <i class="uil uil-history"></i>
                                Lịch sử xuất kho
                            </a>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Ảnh đại diện</th>
                                    <th class="text-center">Tồn kho</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            const columns = [{
                    data: 'index',
                    name: 'index',
                    className: 'text-center',
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                    render: (data) => `
                    <span class='text-dark badge bg-light font-15'>${data}</span>
                `
                },
                {
                    data: 'thumbnail',
                    name: 'thumbnail',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `
                    <img src="{{ asset('asset/admin/products') }}/${data.product_id}/${data.thumbnail}" height="100" width="120" alt="avatar">
                `
                },
                {
                    data: 'stock_quantity',
                    name: 'stock_quantity',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
                {
                    data: 'actions',
                    name: 'actions',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `
                        <span class='table-action d-flex justify-content-center gap-2'>
                            <a href="${data.preview}">
                                <i class="edit text-primary uil-eye action-icon"></i>
                            </a>
                        </span>
            `
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.inventories.getList') }}", columns)
            );
        });
    </script>
@endpush
