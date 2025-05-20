@extends('outside.layout.master')
@section('content')
    <div class="empty"></div>
    <section class="login-section">
        <div class="main-login">
            <div class="logo-login">
                <img src="{{ asset('asset/admin/systemImage/ktech-dark.svg') }}" alt="Ktech dark">
            </div>
            <div class="title mb-2">
                Đăng ký với
            </div>
            <div class="login-with">
                <div class="login-with-google">
                    <img src="{{ asset('asset/outside/icon/google-icon.svg') }}" alt=""> Google
                </div>
            </div>
            <div class="form-login">
                <form action="" id="form-login">
                    @csrf
                    <div class="name-input mb-2">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Họ và tên">
                    </div>
                    <div class="username-input mb-2">
                        <input type="text" class="form-input" name="username" id="username" placeholder="Số điện thoại">
                    </div>
                    <div class="email-input mb-2">
                        <input type="text" class="form-input" name="email" id="email" placeholder="Email ( Không bắt buộc )">
                    </div>
                     <div class="birtday-input mb-2">
                        <input type="text" class="form-input" name="birtday" id="birtday" placeholder="Ngày sinh">
                    </div>
                    <div class="password-input mb-2 ">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="re_password-input ">
                        <input type="text" class="form-input" name="re_password" id="re_password" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="btn-login mt-2">
                        <button type="button" id="btn-submit">
                            Đăng ký
                        </button>
                    </div>
                </form>
            </div>
            <div class="link-register">
                Bạn đã có tài khoản? <a href="{{ route('home.login')}}"> Đăng nhập ngay</a>
            </div>
        </div>
    </section>
@endsection
