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
                                <a href="${data.list}" data-bs-toggle="tooltip" data-bs-placement="top" title="Danh sách sản phẩm cùng phiên bản">
                                    <i class="list text-primary uil uil-list-ul action-icon"></i>
                                </a>
                                <a href="${data.edit}" title="Chỉnh sửa sản phẩm">
                                    <i class="edit text-primary uil-edit action-icon"></i>
                                </a>
                                <form action="${data.destroy}" method="POST" class="action-icon">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="${data.id}" title="Xóa sản phẩm khỏi hệ thống">
                                    <i class="destroy text-danger uil-trash-alt" type="button"></i>
                                </form>
                            </span>
                        `;
                    }
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable(
                    "{{ route('admin.products.productsVersion.getList', $productVersion->slug) }}", columns)
            );

            // $RouteUpdateStatus = ;

            $(document).on('change', '.checkBoxStatus', (e) => {
                const checkbox = e.target;
                const id = $(checkbox).data('id');
                if (checkbox.checked) {
                    const routePost = "{{ route('admin.products.updateStatus') }}";
                    postDataStatus(id, 'checked', routePost);
                } else {
                    const routePost = "{{ route('admin.products.updateStatus') }}";
                    postDataStatus(id, 'check', routePost);
                }
            });
            $routeDelete = '{{ route('admin.products.delete') }}';
            destroy($routeDelete, table);

            $(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        });
        const postDataStatus = (id, status, route) => {
            $.ajax({
                url: route,
                type: "POST",
                dataType: "json",
                data: {
                    product_id: id,
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
