@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Trình chiếu slide
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
                            <a class="btn btn-primary mb-2" href="{{ route('admin.banners.create') }}">
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
                                    <th class="text-center">Ảnh banner</th>
                                    <th class="text-center">Tiêu đề</th>
                                    <th class="text-center">Trạng thái</th>
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
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'banner',
                    name: 'banner',
                    className: 'text-center',
                    render: (data) => `
                    <img src="{{ asset('asset/admin/banners') }}/${data}" height="auto" width="100%" loading="lazy">
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
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `
                        <span class='text-dark'>${data}</span>
                    `
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: (data) => `
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
                `
                }
            ];

            let table = $('#datatable').DataTable(
                customerDatatable("{{ route('admin.banners.getList') }}", columns)
            );

            $(document).on('change', '.checkBoxStatus', (e) => {
                const checkbox = e.target;
                const id = $(checkbox).data('id');
                if (checkbox.checked) {
                    const routePost = "{{ route('admin.banners.updateStatus') }}";
                    postDataStatus(id, 'checked', routePost);
                } else {
                    const routePost = "{{ route('admin.banners.updateStatus') }}";
                    postDataStatus(id, 'check', routePost);
                }
            });

            const routeDelete = "{{ route('admin.banners.delete') }}";
            destroy(routeDelete, table);
        });

        const postDataStatus = (id, status, route) => {
            $.ajax({
                url: route,
                type: "POST",
                dataType: "json",
                data: {
                    banner_id: id,
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
