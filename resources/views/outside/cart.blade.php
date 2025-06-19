@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <div class="breadcrumb1">
        <div class="container">
            <a href="{{ route('home.index') }}">
                <span style="color: #2a52be">
                    Trang chủ
                </span>
            </a>
            <i class=" uil-angle-right-b"></i>
            <span class="text-dark">
                Giỏ hàng
            </span>
        </div>
    </div>
    <section class="list-item-cart">
        @if ($cart_item)
            <div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" id="check-all-product">
                <label class="form-check-label text-dark" for="check-all-product">Chọn tất cả</label>
            </div>
        @endif
        @foreach ($cart_item as $item)
            <div class="item mb-2">
                <div class="product-checkbox">
                    <input type="checkbox" data-price="{{ $item->unit_price }}" data-id="{{ $item->productVersion->id }}"
                        data-quantity="{{ $item->quantity }}" data-thumbnail="{{ $item->productVersion->thumbnail }}"
                        data-name="{{ $item->productVersion->name }}" class="form-check-input product-check"
                        id="product-check">
                </div>
                <div class="product-thumbnail">
                    @if ($item->productVersion)
                        <img src="{{ asset('asset/admin/products/') . '/' . $item->productVersion->id . '/' . $item->productVersion->thumbnail }}"
                            alt="">
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-name">
                        {{ $item->productVersion ? $item->productVersion->name : 'Không có dữ liệu' }}
                    </div>
                    <div class="product-price">
                        {{ formatPriceToVND($item->unit_price) }}
                    </div>
                </div>
                <div class="action">
                    <div class="btn-delete" data-product-id="{{ $item->id }}">
                        <i class="uil uil-trash-alt"></i>
                    </div>
                    <div class="product-quantity mt-1">
                        <div class="quantity-reduce" data-product-id="{{ $item->product_id }}">
                            <i class="uil uil-minus"></i>
                        </div>
                        <div class="quantity">
                            {{ $item->quantity }}
                        </div>
                        <div class="quantity-increase" data-product-id="{{ $item->product_id }}">
                            <i class="uil uil-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="view-price">
            <div class="temporary-price">
                Tạm tính : 0₫
            </div>
            <div class="btn-buy">
                <div class="content" id="btn-buy">
                    <span id="count-buy"> Mua ngay </span>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('js/outside/cart.js') }}"></script>
    <script>
        const RouteCartItemUpdate = "{{ route('home.cartItemUpdate') }}";
        const RouteCartItemDelete = "{{ route('home.detleItemCart') }}";
        const RouteOrder = "{{ route('home.order') }}";
    </script>
@endpush
