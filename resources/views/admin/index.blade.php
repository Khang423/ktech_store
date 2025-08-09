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
            <div class="col-md-6 col-xl-3">
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

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <i class="uil-tv-retro font-36 text-center"></i>
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24"></h3>
                            </div>
                            <h5 class="text-muted fw-normal mt-0 text-center">Gói Truyền Hình FPT PLay</h5>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <i class=" uil-users-alt font-36 text-center"></i>
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24"></h3>
                            </div>
                            <h5 class="text-muted fw-normal mt-0 text-center"> Thành viên</h5>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <i class=" uil-user-square font-36 text-center"></i>
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24"></h3>
                            </div>
                            <h5 class="text-muted fw-normal mt-0 text-center">Khách hàng liên hệ</h5>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-center">
                                <h3 class="my-2 py-1 font-24"> Biểu đồ thống kê doanh thu</h3>
                            </div>
                            <div>
                                <canvas id="myBarChart" width="400" height="200"></canvas>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: `{{ route('admin.getData') }}`,
                method: 'GET',
                success: function(result) {
                    const ctx = document.getElementById('myBarChart').getContext('2d');
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
                },
                error: function(err) {
                    alert('Lỗi khi lấy dữ liệu!');
                    console.log(err);
                }
            });
        });
    </script>
@endpush
