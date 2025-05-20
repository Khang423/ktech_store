@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <section class="login-section">
        <div class="main-login">
            <div class="logo-login">
                <img src="{{ asset('asset/admin/systemImage/ktech-dark.svg') }}" alt="Ktech dark">
            </div>
            <div class="title mb-2">
                Đăng nhập với
            </div>
            <div class="login-with">
                <div class="login-with-google">
                    <img src="{{ asset('asset/outside/icon/google-icon.svg') }}" alt=""> Google
                </div>
            </div>
            <div class="form-login">
                <form action="" id="form-login">
                    @csrf
                    <div class="username-input mb-2">
                        <input type="text" class="form-input" name="username" id="username" placeholder="Số điện thoại">
                    </div>
                    <div class="password-input ">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="btn-login mt-2">
                        <button type="button" id="btn-submit">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
            <div class="link-register">
                Bạn chưa có tài khoản? <a href="{{ route('home.register')}}"> Đăng ký ngay</a>
            </div>
        </div>
    </section>
@endsection
