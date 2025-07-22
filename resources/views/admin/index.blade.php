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
                                <h3 class="my-2 py-1 font-24"></h3>
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
        </div>
    </div>
@endsection
@push('js')
@endpush
