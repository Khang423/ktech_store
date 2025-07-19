@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Từ khoá bộ lọc tìm kiếm
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Danh sách từ
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
                            <a class="btn btn-primary mb-2" href="{{ route('admin.tags.create') }}">
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
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center" style="width: 80px;">Actions</th>
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
                        <a href="${data.preview}" class="action-view" data-id="${data.id}" title="Chi tiết">
                                <i class="edit text-info uil uil-list-ul action-icon"></i>
                            </a>
                        <a href="${data.edit}">
                            <i class="uil-edit text-primary action-icon"></i>
                        </a>
                        <form action="${data.destroy}" method="POST" class="d-inline-block">
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
                customerDatatable("{{ route('admin.tags.getList') }}", columns)
            );

            const routeDestroy = '{{ route('admin.tags.destroy') }}';
            const routeRestore = '{{ route('admin.tags.restoreAll') }}';
            const routeForceDelete = '{{ route('admin.tags.forceDelete') }}';

            forceDelete(routeForceDelete, table);
            restore(routeRestore, table);
            destroy(routeDestroy, table);
        });
    </script>
@endpush
