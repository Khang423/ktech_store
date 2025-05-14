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
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Ảnh banner</th>
                                    <th>Tiêu đề</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 80px;">Actions</th>
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
            let table = $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.banners.getList') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    error: function(data) {
                        console.log(data);
                    }
                },
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                    processing: "Đang xử lý...",
                    search: "Tìm kiếm:",
                    searchPlaceholder: "Từ khoá...",
                    info: "Hiện thị từ _START_ đến _END_ trên _TOTAL_",
                    lengthMenu: 'Show <select class=\'form-select form-select-sm ms-1 me-1\'><option value="50">50</option><option value="100">100</option><option value="200">200</option><option value="-1">All</option></select>'
                },
                pageLength: 20,
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(e, l, a, o) {
                            return e = "display" === l ?
                                '<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>' :
                                e
                        },
                        checkboxes: {
                            selectAllRender: '<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>'
                        }
                    },
                    {
                        data: 'index',
                        name: 'index',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'banner',
                        name: 'banner',
                        render: function(data) {
                            return `
                                <img src="{{ asset('asset/admin/banners')}}/${data}"  height="100" width="120" loading="lazy">
                            `;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            return `
                                <span class='text-dark badge bg-light font-15'>
                                    ${data}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return `
                            <input type="checkbox" id="switch1" ${data} data-switch="success"/>
                            <label for="switch1" data-on-label="Bật" data-off-label="Tắt"></label>
                            `;
                        }
                    },
                    {
                        orderable: false,
                        searchable: false,
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return `
                                <span class='text-dark'>
                                    ${data}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <span class='table-action'>
                                    <a href="${data.edit}">
                                        <i class="edit text-primary uil-edit action-icon">
                                        </i>
                                    </a>

                                    <form action="${data.destroy}" method="POST" class="action-icon">
                                        @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" class="form-control" readonly value="${data.id}">
                                        <i class="destroy text-danger uil-trash-alt" type="button"></i>
                                    </form>
                                </span>
                            `;
                        }
                    }
                ],
                drawCallback: () => {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $(
                            "#products-datatable_length label").addClass("form-label"), document
                        .querySelector(".dataTables_wrapper .row").querySelectorAll(".col-md-6")
                        .forEach(function(e) {
                            e.classList.add("col-sm-6"), e.classList.remove("col-sm-12"), e
                                .classList.remove("col-md-6")
                        })
                },
                rowCallback: function(row, data, index) {
                    $('td:eq(1)', row).html(index + 1 + this.api().page.info().start);
                }
            });

            $routeDelete = '{{ route('admin.banners.delete') }}';
            destroy($routeDelete, table);

        });
    </script>
@endpush
