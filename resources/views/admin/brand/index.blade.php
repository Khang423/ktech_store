@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Thương hiệu
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
                            <a class="btn btn-primary mb-2"
                                href="{{ route('admin.brands.create') }}">
                                <i class="mdi mdi-plus-circle me-2"></i>
                                Thêm
                            </a>
                        </div>
<<<<<<< HEAD
                        <div class="col-6 text-end">
                            <a class="btn btn-info mb-2" id="btn-restore">
                                <i class="uil uil-history me-2"></i>
                                Khôi phục
                            </a>
                            <a class="btn btn-danger mb-2" id="btn-forceDelete">
                                <i class="uil uil-trash-alt"></i>
                                Xoá vĩnh viễn
                            </a>
=======
                        <div class="col-sm-5">
                            <a class="btn btn-primary" id="btn-restore">
                                <i class="uil uil-history me-2"></i>
                                Khôi phục
                            </a>
>>>>>>> bf80720 (update db and feat usagetype status:done)
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Thương hiệu</th>
                                    <th>Logo</th>
                                    <th>Quốc gia</th>
                                    <th>Website</th>
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
                    data: 'logo',
                    name: 'logo',
                    className: 'text-center',
                    render: data =>
                        `<img src="{{ asset('asset/admin/brands') }}/${data.logo}"  height="auto" width="100%" loading="lazy">`
                },

                {
                    data: 'country',
                    name: 'country',
                    className: 'text-center',
                    render: data => `<span class="badge bg-light font-15 text-dark">${data}</span>`
                },
                {
                    data: 'website_link',
                    name: 'website_link',
                    className: 'text-center',
                    render: data => `<a href="${data}" class='text-dark' target="_blank" rel="noopener noreferrer">
                                    ${data}
                                </a>`
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
<<<<<<< HEAD
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.brands.getList') }}", columns)
            );

=======
            });
>>>>>>> bf80720 (update db and feat usagetype status:done)
            const routeDelete = '{{ route('admin.brands.destroy') }}';
            const routeRestore = '{{ route('admin.brands.restoreAll') }}';
            restore(routeRestore, table);
            destroy(routeDelete, table);
        });
    </script>
@endpush
