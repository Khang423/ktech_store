@php
    use App\Enums\OrderStatusEnum;
@endphp

@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Nhà cung cấp
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
                    <div class="row mb-2 col-12">
                        <div class="col-6">
                            <a class="btn btn-success mb-2" href="{{ route('admin.dashboard') }}">
                                <i class="uil uil-step-backward-alt"></i>
                                Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Mã hoá đơn</th>
                                    <th class="text-center">Người đặt</th>
                                    {{-- <th class="text-center">SĐT </th> --}}
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Tổng tiền</th>
                                    <th class="text-center">Ngày đặt</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center" style="width: 80px;">Hàng động</th>
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
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                },
                {
                    data: 'order_code',
                    name: 'order_code',
                    className: 'text-center',
                    render: (data) => `<span class='text-dark badge bg-light font-15'>${data}</span>`
                },
                {
                    data: 'customer',
                    name: 'customer',
                    className: 'text-center',
                    render: (data) => `<span class='text-dark badge bg-light font-15'>${data}</span>`
                },
                // {
                //     data: 'receiver_tel',
                //     name: 'receiver_tel',
                //     className: 'text-center',
                //     render: (data) => `<span class='text-dark badge bg-light font-15'>${data}</span>`
                // },
                {
                    data: 'receiver_email',
                    name: 'receiver_email',
                    className: 'text-center',
                    render: (data) => `<span class='text-dark badge bg-light font-15'>${data}</span>`
                },
                {
                    data: 'total_price',
                    name: 'total_price',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `<span class='text-dark badge bg-light font-15'>${data}</span>`
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `<span class='text-dark '>${data}</span>`
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
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => {
                        if (data.status === 4) //DELIVERED
                        {
                            return `
                                <span class='table-action d-flex justify-content-center gap-2'>
                                    <a href="${data.preview}">
                                        <i class="edit text-primary uil uil-print action-icon"></i>
                                    </a>
                                </span>
                            `;
                        } else if (data.status === 2) // processing
                        {
                            return `
                                <span class='table-action d-flex justify-content-center gap-2'>
                                    <i data-id="${data.id}" data-status="cancel" class="btn-updateStatus text-danger uil uil-file-times-alt action-icon"></i>
                                    <a href="${data.preview}">
                                        <i class="edit text-primary uil uil-print action-icon"></i>
                                    </a>
                                </span>
                            `;
                        } else if (data.status === 5) // processing
                        {
                            return `
                                <span class='table-action d-flex justify-content-center gap-2'>
                                    <i data-id="${data.id}" data-status="accept" class="btn-updateStatus text-success uil uil-file-check-alt action-icon"></i>
                                    <a href="${data.preview}">
                                        <i class="edit text-primary uil uil-print action-icon"></i>
                                    </a>
                                </span>
                            `;
                        }
                        return `
                            <span class='table-action d-flex justify-content-center gap-2'>
                                <i data-id="${data.id}" data-status="accept" class="btn-updateStatus text-success uil uil-file-check-alt action-icon"></i>
                                <i data-id="${data.id}" data-status="cancel" class="btn-updateStatus text-danger uil uil-file-times-alt action-icon"></i>
                                <a href="${data.preview}">
                                    <i class="edit text-primary uil uil-print action-icon"></i>
                                </a>
                            </span>
                        `;
                    }
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.orders.getList') }}", columns)
            );

            const routeDestroy = '{{ route('admin.orders.destroy') }}';
            const routeRestore = '{{ route('admin.orders.restoreAll') }}';
            const routeForceDelete = '{{ route('admin.orders.forceDelete') }}';

            forceDelete(routeForceDelete, table);
            restore(routeRestore, table);
            destroy(routeDestroy, table);

            $('#datatable').on('click', '.btn-updateStatus', (e) => {
                const id = $(e.currentTarget).data('id');
                const status = $(e.currentTarget).data('status');
                const route = "{{ route('admin.orders.updateStatus') }}"
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
                    order_id: id,
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
