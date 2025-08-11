@extends('admin.layout.master')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <i class="uil uil-laptop font-36 text-center"></i>
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24">{{ $countProduct }}</h3>
                            </div>
                            <h5 class="text-muted fw-normal mt-0 text-center">Số lượng sản phẩm</h5>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <i class=" uil-users-alt font-36 text-center"></i>
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24">{{ $countMember }}</h3>
                            </div>
                            <h5 class="text-muted fw-normal mt-0 text-center"> Thành viên</h5>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <i class=" uil-user-square font-36 text-center"></i>
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24">{{ $countCustomer }}</h3>
                            </div>
                            <h5 class="text-muted fw-normal mt-0 text-center">Khách hàng</h5>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24"> Biểu đồ thống kê doanh thu theo tháng <span
                                        id="month"></span></h3>
                            </div>
                            <div class="row col-8 align-items-start">
                                <h4 class="my-2 py-1"> Công cụ thống kê :</h4>
                                <div class="col-5">
                                    <input type="text" id="from-date" name="from-date" class="form-control"
                                        name="Sinh nhật" placeholder="Ngày bắt đầu">
                                </div>
                                <div class="col-5">
                                    <input type="text" id="to-date" name="to-date" class="form-control"
                                        name="Sinh nhật" placeholder="Ngày kết thúc">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success" id="btn-search" style="height:48px">
                                        <span>Tìm kiếm</span>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <canvas id="myBarChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="row col-12 align-items-center">
                            {{-- tổng doanh thu --}}
                            <div class="text-dark fs-4">
                                <h4>Tổng doanh thu :</h4> <span id="total-revenue"
                                    class="fs-5 badge bg-light text-primary"></span>
                            </div>
                            {{-- tổng lợi nhuận --}}
                            <div class="text-dark fs-4 ">
                                <h4>Tổng lợi nhuận :</h4><span id="total-profit" class="fs-5 badge bg-light"></span>
                            </div>
                        </div><!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="col-12 text-center">
                                    <h3 class="my-2 py-1 font-24"> Doanh thu của sản phẩm</h3>
                                </div>
                                <div>
                                    <canvas id="detail" width="400" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12 text-center">
                                    <h3 class="my-2 py-1 font-24"> Số lượng đơn hàng của tháng</h3>
                                </div>
                                <div>
                                    <canvas id="order" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#from-date').datepicker({
                uiLibrary: 'bootstrap5'
            });
            $('#to-date').datepicker({
                uiLibrary: 'bootstrap5'
            });

            $('#btn-search').on('click', (e) => {
                const from_date = $('#from-date').val();
                const to_date = $('#to-date').val();

                $.ajax({
                    url: `{{ route('admin.chartSearch') }}`,
                    method: 'POST',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },

                    success: function(result) {
                        const ctx = document.getElementById('myBarChart').getContext('2d');
                        const detail = document.getElementById('detail').getContext('2d');
                        const order = document.getElementById('order').getContext('2d');
                        const total_revenue = $('#total-revenue');
                        const total_profit = $('#total-profit');
                        if (Chart.getChart("myBarChart")) {
                            Chart.getChart("myBarChart").destroy();
                        }

                        if (Chart.getChart("detail")) {
                            Chart.getChart("detail").destroy();
                        }
                        if (Chart.getChart("order")) {
                            Chart.getChart("order").destroy();
                        }
                        total_revenue.text(
                            Number(result.revenus).toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })
                        );

                        if (result.profit < 0) {
                            total_profit.addClass('text-danger');

                        } else {
                            total_profit.addClass('text-success');
                        }

                        let profit = Number(result.profit);
                        let sign = profit > 0 ? '+' : '';
                        total_profit.text(
                            sign + profit.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })
                        );

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: result.labels,
                                datasets: [{
                                    label: 'Doanh thu (triệu VND)',
                                    data: result.data,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        new Chart(detail, {
                            type: 'bar',
                            data: {
                                labels: result.labels_detail,
                                datasets: [{
                                    label: 'Doanh thu (triệu VND)',
                                    data: result.data_detail,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        new Chart(order, {
                            type: 'bar',
                            data: {
                                labels: result.labels,
                                datasets: [{
                                    label: 'Số lượng đơn hàng',
                                    data: result.order,
                                    backgroundColor: 'rgba(73, 142, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function(err) {
                        toast('Lỗi khi lấy dữ liệu', 'error');
                        console.log(err);
                    }
                });
            });

            $.ajax({
                url: `{{ route('admin.getData') }}`,
                method: 'GET',
                success: function(result) {
                    const ctx = document.getElementById('myBarChart').getContext('2d');
                    const detail = document.getElementById('detail').getContext('2d');
                    const order = document.getElementById('order').getContext('2d');
                    const total_revenue = $('#total-revenue');
                    const total_profit = $('#total-profit');

                    const revenue = result.revenus.reduce((sum, val) => sum + val, 0);

                    total_revenue.text(
                        revenue.toLocaleString('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        })
                    );

                    if (result.profit < 0) {
                        total_profit.addClass('text-danger');

                    } else {
                        total_profit.addClass('text-success');
                    }

                    const profit = result.profit.reduce((sum, val) => sum + val, 0);
                    const sign = profit > 0 ? '+' : '';

                    total_profit.text(
                        sign + profit.toLocaleString('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        })
                    );

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: result.labels,
                            datasets: [{
                                label: 'Doanh thu (triệu VND)',
                                data: result.data,
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    new Chart(detail, {
                        type: 'bar',
                        data: {
                            labels: result.labels_detail,
                            datasets: [{
                                label: 'Doanh thu (triệu VND)',
                                data: result.data_detail,
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    new Chart(order, {
                        type: 'bar',
                        data: {
                            labels: result.labels,
                            datasets: [{
                                label: 'Số lượng đơn hàng',
                                data: result.order,
                                backgroundColor: 'rgba(73, 142, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(err) {
                    toast('Lỗi khi lấy dữ liệu', 'error');
                    console.log(err);
                }
            });
        });
    </script>
@endpush
