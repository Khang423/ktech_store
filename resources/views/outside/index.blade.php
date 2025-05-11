@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <section id="section-slide">
        <div class="slide">
            <h1>Slide</h1>
        </div>
    </section>
    <div class="product-title mt-3">
        <h2 class="text-dark">
            LAPTOP
        </h2>
    </div>
    <section id="section-laptop">
        <div class="card-product mt-3">
            <div class="product-content">
                <div class="product-discount d-flex">
                    <img src="{{ asset('asset/outside/icon/sale.png')}}" alt="Icon sale">
                    <div class="percent-discount">
                        Giảm 30%
                    </div>
                </div>
                <div class="product-thumbnail">
                    <img src="{{ asset('asset/admin/products/2/thumbnail_6820050d6115b.webp')}}" alt="Product Image">
                </div>
                <div class="product-title ">
                    <h4> Iphone 16</h4>
                </div>
                <div class="product-price">
                    <h4>30.000.000đ</h4>
                </div>
                <div class="product-rate d-flex">
                    <img src="{{ asset('asset/outside/icon/star.png')}}" alt="">
                    <img src="{{ asset('asset/outside/icon/star.png')}}" alt="">
                    <img src="{{ asset('asset/outside/icon/star.png')}}" alt="">
                    <img src="{{ asset('asset/outside/icon/star.png')}}" alt="">
                    <img src="{{ asset('asset/outside/icon/star.png')}}" alt="">
                    <div class="title-heart">
                        Yêu thích
                    </div>
                    <div class="icon-heart">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="product-title mt-3">
        <h2 class="text-dark">
            ĐIỆN THOẠI
        </h2>
    </div>
@endsection
