@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Danh mục: {{ $tag->name }}
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            Danh sách
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Thêm
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-store">
                                @csrf
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row" hidden>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <select class="form-select" id="tag_id" name="tag_id"
                                                style="height: 48px">
                                                <option value="{{ $tag->id }}">
                                                    {{ $tag->name }}
                                                </option>
                                            </select>
                                            <div class="text-danger mt-1 error-tag_id"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Tên từ khoá</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Tên từ khoá " name="name">
                                                <div class="text-danger mt-1 error-name"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="btn-store">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    <span>Thêm</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {

            const $form = $('#form-store');
            const $inputs = $form.find('input');
            $routeStore =
                "{{ route('admin.tags.tagDetail.store', ['tag' => $tag->slug]) }}";
            $routeIndex = "{{ route('admin.tags.detail', ['tag' => $tag->slug]) }}";
            // function handle
            store($routeStore, $routeIndex);
            deleteAlertValidation($inputs);
        });
    </script>
@endpush
