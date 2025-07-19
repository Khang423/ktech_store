@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Kho hàng
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            Lịch sử xuất kho
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
                                    <th class="text-center">Mã Nhập</th>
                                    <th class="text-center">Người nhập</th>
                                    <th class="text-center">Tổng giá trị</th>
                                    <th class="text-center">Ngày nhập</th>
                                    <th class="text-center">Lần cập nhật cuối</th>
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
                    data: 'member_id',
                    name: 'member_id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
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
                    data: 'actions',
                    name: 'actions',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data) => `
                        <span class='table-action d-flex justify-content-center gap-2'>
                            <a href="${data.preview}" class="action-view" data-id="${data.id}">
                                <i class="edit text-info uil-eye action-icon"></i>
                            </a>
                            <a href="${data.edit}">
                                <i class="edit text-primary uil-edit action-icon"></i>
                            </a>
                            <form action="${data.destroy}" method="POST" class="d-inline action-icon" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="${data.id}">
                                <button type="submit" class="btn p-0 border-0 bg-transparent">
                                    <i class="destroy text-danger uil-trash-alt"></i>
                                </button>
                            </form>
                        </span>
            `
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.stockImports.getList') }}", columns)
            );

        });
    </script>
@endpush
