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
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a class="btn btn-primary mb-2" href="{{ route('admin.brands.create') }}">
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
                                    <th>#</th>
                                    <th>Thương hiệu</th>
                                    <th>Logo</th>
                                    <th>Quốc gia</th>
                                    <th>Website</th>
                                    <th>Trạng thái</th>
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
            let table = $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.brands.getList') }}",
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
                    processing: "Processing...",
                    search: "Search:",
                    searchPlaceholder: "Keywords...",
                    info: "Hiện thị từ _START_ đến _END_ trên _TOTAL_",
                    lengthMenu: 'Show <select class=\'form-select form-select-sm ms-1 me-1\'><option value="50">50</option><option value="100">100</option><option value="200">200</option><option value="-1">All</option></select>'
                },
                pageLength: 20,
                columns: [
                    {
                        data: 'index',
                        name: 'index',
                        orderable: false,
                        searchable: false,
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
                        data: 'logo',
                        name: 'logo',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                <img src="{{ asset('asset/admin/brands') }}/${data.logo}"  height="100" width="120" loading="lazy">
                            `;
                        }
                    },
                    {
                        data: 'country',
                        name: 'country',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                <span class='text-dark'>
                                    ${data}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'website_link',
                        name: 'website_link',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                <a href="${data}" class='text-dark' target="_blank" rel="noopener noreferrer">
                                    ${data}
                                </a>
                            `;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                <span class='text-dark'>
                                    ${data}
                                </span>
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
                    $('td:eq(0)', row).html(index + 1 + this.api().page.info().start);
                }
            });
            $routeDelete = '{{ route('admin.brands.delete') }}';
            destroy($routeDelete, table);
        });
    </script>
@endpush
