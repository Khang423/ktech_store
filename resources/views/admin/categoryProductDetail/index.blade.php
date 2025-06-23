@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh mục: {{ $categoryProduct->name }}
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
                                href="{{ route('admin.categoryProducts.details.create', $categoryProduct->slug) }}">
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
                customerDatatable("{{ route('admin.categoryProducts.getListDetail', $categoryProduct->slug) }}",
                    columns)
            );

            $routeDelete = '{{ route('admin.categoryProducts.details.delete', $categoryProduct->slug) }}';
            destroy($routeDelete, table);
        });
    </script>
@endpush
