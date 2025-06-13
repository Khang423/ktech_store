@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Sản phẩm
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
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a class="btn btn-primary mb-2" href="{{ route('admin.products.create') }}">
                                <i class="mdi mdi-plus-circle me-2"></i>
                                Thêm
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="text-sm-end">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Ảnh </th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center" style="width: 80px;">Hành động</th>
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
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                    render: function(data) {
                        return `
                <span class='text-dark badge bg-light font-15'>${data}</span>
            `;
                    }
                },
                {
                    data: 'thumbnail',
                    name: 'thumbnail',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `
                <img src="/asset/admin/products/${data.id}/${data.thumbnail}" height="100" width="100" class="me-3">
            `;
                    }
                },
                {
                    data: 'price',
                    name: 'price',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `<span class='text-dark'>${data}</span>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `<span class='text-dark'>${data}</span>`;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data) {
                        return `<span class='text-dark'>${data}</span>`;
                    }
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        return `
                            <span class='table-action'>
                                <a href="${data.edit}">
                                    <i class="edit text-primary uil-edit action-icon"></i>
                                </a>
                                <form action="${data.destroy}" method="POST" class="action-icon">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="${data.id}">
                                    <i class="destroy text-danger uil-trash-alt" type="button"></i>
                                </form>
                            </span>
                        `;
                    }
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.products.getList') }}", columns)
            );

            $routeDelete = '{{ route('admin.products.delete') }}';
            destroy($routeDelete, table);
        });
    </script>
@endpush
