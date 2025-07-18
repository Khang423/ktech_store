@extends('admin.layout.master')
@section('title')
    <div class="text-dark">
        <span class="text-primary">
            Sản phẩm
        </span>
        <i class="mdi mdi-chevron-right"></i>
        <span class="text-primary">
            <a href="{{ route('admin.products.index') }}">Danh sách</a>
        </span>
        <i class="mdi mdi-chevron-right"></i>
        Cập nhật
    </div>
@endsection
@section('content')
    <form method="post" enctype="multipart/form-data" autocomplete="off" id="form-update">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8">
                {{-- Information --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Thông tin</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Tên sản phẩm" name="name" value="{{ $products->name }}">
                                            <div class="text-danger mt-1 error-name"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="brand_id" class="form-label">Thương hiệu </label>
                                            <select class="form-select" id="brand_id" name="brand_id" style="height: 48px">
                                                <option value="" hidden>Chọn thương hiệu</option>
                                                @foreach ($brand as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($products->brand_id == $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-brand_id"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="model_series_id" class="form-label">Seri sản phẩm </label>
                                            <select class="form-select" id="model_series_id" name="model_series_id"
                                                style="height: 48px">
                                            </select>
                                            <div class="text-danger mt-1 error-model_series_id"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="category_product_id" class="form-label">Loại sản phẩm</label>
                                            <select class="form-select" id="category_product_id" name="category_product_id"
                                                style="height: 48px">
                                                <option value="" hidden>Chọn loại sản phẩm</option>
                                                @foreach ($category_product as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($products->category_product_id == $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger mt-1 error-category_product_id"></div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="usage_type_id" class="form-label">Nhu cầu sử dụng </label>
                                            <select class="form-select" id="usage_type_id" name="usage_type_id"
                                                style="height: 48px">
                                            </select>
                                            <div class="text-danger mt-1 error-usage_type_id"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Description --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="custom-styles-preview">
                                <h4 class="header-title mb-3">Mô tả sản phẩm</h4>
                                <textarea class="form-control tinymce-editor" name="description" rows="10">
                                    {{ $products->description }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        @if ($products->thumbnail !== null)
                            <label class="text-dark header-title font-16 fw-bold">
                                Ảnh trưng bày
                            </label>
                            <div class="d-flex justify-content-center mb-2 mt-2">
                                <div id="preview-thumbnail">
                                    <img src="{{ asset('asset/admin/products') . '/' . $products->id . '/' . $products->thumbnail }}"
                                        width="250" height="auto" class="img-fluid img-thumbnail mt-2 mb-2">
                                </div>
                            </div>
                            <input name="thumbnail_old" type="hidden"style="display: none"
                                value="{{ $products->thumbnail }}" />
                            <input name="thumbnail_new" type="file" id="img_thumbnail" style="display: none" />
                            <div class="thumbnail text-center dropzone">
                                <i class="h1 text-muted uil-upload-alt"></i>
                                <h3>Chọn ảnh </h3>
                            </div>
                            <div class="error-thumbnail text-center text-danger"></div>
                        @else
                            <label class="text-dark header-title font-16 fw-bold">
                                Ảnh trưng bày
                            </label>
                            <div class="d-flex justify-content-center mb-2 mt-2">
                                <div id="preview-thumbnail">
                                </div>
                            </div>
                            <input name="thumbnail" type="file" id="img_thumbnail" style="display: none" />
                            <div class="thumbnail text-center dropzone">
                                <i class="h1 text-muted uil-upload-alt"></i>
                                <h3>Chọn ảnh </h3>
                            </div>
                            <div class="error-thumbnail text-center text-danger"></div>
                        @endif
                    </div>
                </div>
                {{-- //  image detail --}}
                <div class="card">
                    <div class="card-body">
                        <lable class="text-dark header-title font-16 fw-bold">
                            Ảnh chi tiết
                        </lable>
                        <div class="d-flex justify-content-center mb-2 mt-2">
                            <div id="preview-image"></div>
                        </div>
                        <div class="mt-2">
                            <input name="image_add[]" type="file" id="imgInput" style="display: none" multiple>
                            <div class="dz-message-image text-center dropzone">
                                <i class="h1 text-muted uil-upload-alt"></i>
                                <h3>Chọn nhiều ảnh</h3>
                            </div>
                        </div>
                        <div class="error-new-image text-center text-danger"></div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <lable class="text-dark header-title font-16 fw-bold">
                                Ảnh chi tiết cũ
                            </lable>
                            <div class=" mb-2 mt-2">
                                @foreach ($product_image as $index => $image)
                                    <div class="mt-2 text-center image-container">
                                        <i class="destroy-image btn btn-link uil-times-square font-24 text-danger"
                                            data-id="{{ $image->id }}"></i>

                                        <img src="{{ asset('asset/admin/products') . '/' . $image->product_id . '/image/' . $image->image }}"
                                            class="old-img img-fluid img-thumbnail me-3" width="170" height="auto">

                                        <input type="file" name="image_update[{{ $index }}]" class="mt-2">

                                        <input type="hidden" name="product_id[{{ $index }}]"
                                            value="{{ $image->product_id }}" readonly>
                                        <input type="hidden" name="product_image_old_id[{{ $index }}]"
                                            value="{{ $image->id }}" readonly>
                                        <input type="hidden" name="image_old[{{ $index }}]"
                                            value="{{ $image->image }}" readonly>
                                    </div>
                                    <div class="error-img text-center text-danger mt-2"
                                        id="error-img-{{ $image->id }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active">
                                    <button class="btn btn-primary" id="btn-update" onclick="tinymce.triggerSave()">
                                        <i class="mdi mdi-plus-circle me-2"></i>
                                        <span>Cập nhật</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('css')
@endpush
@push('js')
    <script src="{{ asset('js/admin/product.js') }}"></script>
    <script>
        $(document).ready(() => {
            $('#brand_id').on('change', (e) => {
                const brand_id = $(e.target).val();
                loadModelSeries(brand_id);
            });

            // Tự động gọi khi brand đã có sẵn (ví dụ trong trang edit)
            const initialBrandId = $('#brand_id').val();
            if (initialBrandId) {
                loadModelSeries(initialBrandId);
            }

            $('#category_product_id').on('change', (e) => {
                const categoryid = $(e.target).val();
                loadUsageType(categoryid);
            });

            // Gọi tự động khi trang load nếu có sẵn category
            const initialCategoryId = $('#category_product_id').val();
            if (initialCategoryId) {
                loadUsageType(initialCategoryId);
            }
            // init
            const $form = $('#form-update');
            const inputs = $form.find('input');
            const routeUpdate = '{{ route('admin.products.update', $products->slug) }}';
            const routeIndex = '{{ route('admin.products.index', $products->slug) }}';
            const routedestroy = "{{ route('admin.products.destroy-image') }}";
            // load data category product detail

            update(routeUpdate, routeIndex);
            deleteAlertValidation(inputs);

            $(".destroy-image").on("click", function() {
                const button = $(this).parent();
                const errorImage = $(this).data("id");

                const image = $(this).siblings('input[name^="image_old["]').val();
                const productId = $(this).siblings('input[name^="product_id["]').val();
                const imageId = $(this).siblings('input[name^="product_image_id["]').val();

                $.ajax({
                    url: routedestroy,
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: imageId,
                        product_id: productId,
                        image: image,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function() {
                        button.remove();
                    },
                    error: function(data) {
                        $.each(data.responseJSON.errors, (key, value) => {
                            $(`#error-img${errorImage}`).text(value);
                        });
                    },
                });
            });

        });


        const loadUsageType = (categoryid) => {
            if (!categoryid) return;

            $.ajax({
                url: `{{ route('admin.products.getDataUsageType') }}`,
                type: "POST",
                dataType: "json",
                data: {
                    category_product_id: categoryid,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: (response) => {
                    const data = response.data;
                    const usageTypeSelect = $('#usage_type_id');
                    usageTypeSelect.empty();

                    data.forEach((item) => {
                        const selected = "{{ $products->usage_type_id }}" == item.id ? 'selected' :
                            '';
                        usageTypeSelect.append(
                            `<option value="${item.id}" ${selected}>${item.name}</option>`
                        );
                    });

                    usageTypeSelect.trigger('change');
                },
                error: (err) => {
                    console.log(err);
                },
            });
        };
        const loadModelSeries = (brand_id) => {
            if (!brand_id) return;

            $.ajax({
                url: `{{ route('admin.products.getDataModelSeries') }}`,
                type: "POST",
                dataType: "json",
                data: {
                    brand_id: brand_id,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: (response) => {
                    const data = response.data;
                    const modelSeriesSelect = $("#model_series_id");
                    modelSeriesSelect.empty();

                    data.forEach((item) => {
                        const selected =
                            "{{ $products->model_series_id }}" == item.id ?
                            "selected" :
                            "";
                        modelSeriesSelect.append(
                            `<option value="${item.id}" ${selected}>${item.name}</option>`
                        );
                    });

                    modelSeriesSelect.trigger("change");
                },
                error: (error) => {
                    console.log(error);
                },
            });
        };
    </script>
@endpush
