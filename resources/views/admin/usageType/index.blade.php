@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Loại sử dụng
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
                            <a class="btn btn-primary mb-2"
                                href="{{ route('admin.categoryProducts.usageTypes.create', $category_product->slug) }}">
                                <i class="mdi mdi-plus-circle me-2"></i>
                                Thêm
                            </a>
                        </div>
                        <div class="col-sm-5">
                            <a class="btn btn-primary" id="btn-restore">
                                <i class="uil uil-history me-2"></i>
                                Khôi phục
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Slug</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 80px;">Hành động</th>
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
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                    render: data => `<span class="badge bg-light font-15 text-dark">${data}</span>`
                },
                {
                    data: 'slug',
                    name: 'slug',
                    className: 'text-center',
                    render: data => `<span class="badge bg-light font-15 text-dark">${data}</span>`
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center',
                    render: data => data ?? ''
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `
                    <span class='table-action d-flex justify-content-center gap-2'>
                        <a href="${data.detail}" class="action-view" data-id="${data.id}" title="Chi tiết">
                                <i class="edit text-info uil uil-list-ul action-icon"></i>
                            </a>
                        <a href="${data.edit}">
                            <i class="uil-edit text-primary action-icon"></i>
                        </a>
                        <form action="${data.delete}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="${data.id}">
                            <i class="uil-trash-alt text-danger destroy action-icon" type="button"></i>
                        </form>
                    </span>
                `
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable(
                    "{{ route('admin.categoryProducts.usageTypes.getList', $category_product->slug) }}", columns
                )
            );

            const routeDelete = "{{ route('admin.categoryProducts.usageTypes.delete', $category_product) }}";
            const routeRestore = '{{ route('admin.brands.restoreAll') }}';
            restore(routeRestore, table);
            destroy(routeDelete, table);
        });
    </script>
@endpush
