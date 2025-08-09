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
                                    <th class="text-center">Trạng thái</th>
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
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                    render: (data, type, row) => {
                        const isChecked = data == 0 ? 'checked' : 'check';
                        const switchId = `switch-${row.id}`;
                        return `
                        <input type="checkbox" id="${switchId}" class="checkBoxStatus" data-id="${row.id}" ${isChecked} data-switch="success"/>
                        <label for="${switchId}" data-on-label="Bật" data-off-label="Tắt"></label>
                    `;
                    }
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

            $(document).on('change', '.checkBoxStatus', (e) => {
                const checkbox = e.target;
                const id = $(checkbox).data('id');
                if (checkbox.checked) {
                    const routePost = "{{ route('admin.stockImports.updateStatus') }}";
                    postDataStatus(id, 'checked', routePost);
                } else {
                    const routePost = "{{ route('admin.stockImports.updateStatus') }}";
                    postDataStatus(id, 'check', routePost);
                }
            });
        });

        const postDataStatus = (id, status, route) => {
            $.ajax({
                url: route,
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    status: status,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function() {
                    toast('Cập nhật thành công', 'success');
                },
                error: function(data) {
                    toast('Cập nhật thất bại', 'error')
                },
            });
        }
    </script>
@endpush
