@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh sách sản phẩm
        </span>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="row mb-2 col-12">
                            <div class="col-6">
                                <a class="btn btn-success mb-2" href="{{ route('admin.dashboard') }}">
                                    <i class="uil uil-step-backward-alt"></i>
                                    Quay lại
                                </a>
                                <a class="btn btn-primary mb-2" href="{{ route('admin.products.create') }}">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Thêm
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-info mb-2" id="btn-restore">
                                    <i class="uil uil-history me-2"></i>
                                    Khôi phục
                                </a>
                                <a class="btn btn-danger mb-2" id="btn-forceDelete">
                                    <i class="uil uil-trash-alt"></i>
                                    Xoá vĩnh viễn
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Sản phẩm</th>
                                        <th class="text-center">Ảnh </th>
                                        {{-- <th class="text-center">Đơn giá</th> --}}
                                        <th class="text-center">Trạng thái</th>
                                        {{-- <th class="text-center">Ngày tạo</th> --}}
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
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                            <span class='table-action'>
                                <a href="${data.view}" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="list text-primary uil uil-eye action-icon"></i>
                                </a>
                                <a href="${data.list}" data-bs-toggle="tooltip" data-bs-placement="top" title="Danh sách sản phẩm cùng phiên bản">
                                    <i class="list text-primary uil uil-list-ul action-icon"></i>
                                </a>
                                <a href="${data.edit}" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="edit text-primary uil uil-edit action-icon"></i>
                                </a>
                                <form action="${data.destroy}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="${data.id}">
                                <i class="uil-trash-alt text-danger destroy action-icon" type="button"></i>
                            </form>
                            </span>
                        `;
                        }
                    }
                ];

                let table = $('#datatable').DataTable(
                    customerDatatable("{{ route('admin.products.getList') }}", columns)
                );


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

                $(function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                });

                const routeDestroy = '{{ route('admin.products.destroy') }}';
                const routeRestore = '{{ route('admin.products.restoreAll') }}';
                const routeForceDelete = '{{ route('admin.products.forceDelete') }}';

                forceDelete(routeForceDelete, table);
                restore(routeRestore, table);
                destroy(routeDestroy, table);
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
