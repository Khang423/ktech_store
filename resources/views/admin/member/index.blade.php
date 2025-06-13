@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Tài khoản
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
                            <a class="btn btn-primary mb-2" href="{{ route('admin.members.create') }}">
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
                                    <th class="text-center">Tài khoản</th>
                                    <th class="text-center">Ảnh đại diện</th>
                                    <th class="text-center">Giới tính</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Email</th>
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
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
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
                    data: 'avatar',
                    name: 'avatar',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `
                    <img src="{{ asset('asset/admin/members') }}/${data}" class="rounded-circle me-3" height="60" width="60" alt="avatar">
                `
                },
                {
                    data: 'gender',
                    name: 'gender',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
                {
                    data: 'phone',
                    name: 'phone',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `<span class='text-dark'>${data}</span>`
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `<span class='text-dark'>${data}</span>`
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
                customerDatatable("{{ route('admin.members.getList') }}", columns)
            );

            $routeDelete = '{{ route('admin.members.delete') }}';
            destroy($routeDelete, table);
        });
    </script>
@endpush
