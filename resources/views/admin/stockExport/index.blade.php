@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Phiếu xuất kho
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Danh sách
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
                                    <th class="text-center">Mã phiếu xuất</th>
                                    <th class="text-center">Mã hoá đơn</th>
                                    <th class="text-center">Tổng giá trị</th>
                                    <th class="text-center">Ngày tạo phiếu</th>
                                    <th class="text-center">Lần cập nhật cuối</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Thao tác</th>
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
                    data: 'ref_code',
                    name: 'ref_code',
                    className: 'text-center',
                    render: (data) => `
                    <span class='text-dark badge bg-light font-15'>${data}</span>
                `
                },
                {
                    data: 'order_code',
                    name: 'order_code',
                    className: 'text-center',
                    render: (data) => `
                    <span class='text-dark badge bg-light font-15'>${data}</span>
                `
                },
                {
                    data: 'total_amount',
                    name: 'total_amount',
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
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => data
                },
                {
                    data: 'actions',
                    name: 'actions',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => {
                        if (data.status === 3) {
                            return `
                                <span class='table-action d-flex justify-content-center gap-2'>
                                </span>
                            `;
                        } else if (data.status === 2) {
                            return `
                                <span class='table-action d-flex justify-content-center gap-2'>
                                    <i data-id="${data.id}" data-status="accept" class="btn-updateStatus text-success uil uil-file-check-alt action-icon"></i>
                                    <i data-id="${data.id}" data-status="cancel" class="btn-updateStatus text-danger uil uil-file-times-alt action-icon"></i>
                                </span>
                            `;
                        } else if (data.status === 5) {
                            return `
                                <span class='table-action d-flex justify-content-center gap-2'>
                                </span>
                            `;
                        }
                    }
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.stockExports.getList') }}", columns)
            );

            $('#datatable').on('click', '.btn-updateStatus', (e) => {
                const id = $(e.currentTarget).data('id');
                const status = $(e.currentTarget).data('status');
                const route = "{{ route('admin.stockExports.updateStatus') }}"
                if (status === 'accept') {
                    postDataStatus(id, status, route, table);
                } else if (status === 'cancel') {
                    postDataStatus(id, status, route, table);
                }
            });
        });

        const postDataStatus = (id, status, route, table) => {
            $.ajax({
                url: route,
                type: "POST",
                dataType: "json",
                data: {
                    stock_export_id: id,
                    status: status,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function() {
                    toast('Cập nhật thành công', 'success');
                    table.draw();
                },
                error: function(data) {
                    toast('Cập nhật thất bại', 'error')
                },
            });
        }
    </script>
@endpush
