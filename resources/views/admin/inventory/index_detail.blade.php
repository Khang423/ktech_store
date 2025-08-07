@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
        Chi tiết kho h
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
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Mã HĐ nhập</th>
                                    <th class="text-center">Phiên bản</th>
                                    <th class="text-center">Giá nhập</th>
                                    <th class="text-center">Giá bán</th>
                                    <th class="text-center">Tồn kho</th>
                                    <th class="text-center">Ngày nhập</th>
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
                    data: 'import_code',
                    name: 'import_code',
                    className: 'text-center',
                    render: (data) => `
                    <span class='text-dark badge bg-light font-15'>${data}</span>
                `
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
                    data: 'price',
                    name: 'price',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
                {
                    data: 'final_price',
                    name: 'final_price',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `<span class='text-dark'>${data}</span>`
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
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
            //     {
            //         data: 'actions',
            //         name: 'actions',
            //         className: 'text-center',
            //         orderable: false,
            //         searchable: false,
            //         render: (data) => `
            //             <span class='table-action d-flex justify-content-center gap-2'>
            //                 <a href="${data.preview}">
            //                     <i class="edit text-primary uil-eye action-icon"></i>
            //                 </a>
            //             </span>
            // `
            //     }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.inventories.details.getList', $products->slug) }}", columns)
            );
        });
    </script>
@endpush
