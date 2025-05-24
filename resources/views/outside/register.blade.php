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
                <form action="{{ route('home.registerProcess') }}" method="post" id="form-register">
                    @csrf
                    <div class="name-input mb-2">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Họ và tên">
                        <div class="text-danger mt-1 error-name"></div>
                    </div>
                    <div class="tel-input mb-2">
                        <input type="text" class="form-input" name="tel" id="tel" placeholder="Số điện thoại">
                        <div class="text-danger mt-1 error-tel"></div>
                    </div>
                    <div class="email-input mb-2">
                        <input type="text" class="form-input" name="email" id="email"
                            placeholder="Email ( Không bắt buộc )">
                            <div class="text-danger mt-1 error-email"></div>
                    </div>
                    <div class="birthday-input mb-2">
                        <input type="text" class="form-input" name="birthday" id="birthday" placeholder="Ngày sinh">
                        <div class="text-danger mt-1 error-birthday"></div>
                    </div>
                    <div class="password-input mb-2 ">
                        <input type="text" class="form-input" name="password" id="password" placeholder="Nhập mật khẩu">
                        <div class="text-danger mt-1 error-password"></div>
                    </div>
                    <div class="re_password-input ">
                        <input type="text" class="form-input" name="re_password" id="re_password"
                            placeholder="Nhập lại mật khẩu">
                            <div class="text-danger mt-1 error-re_password"></div>
                    </div>
                      <div class="btn-login-customer mt-2">
                        <button type="submit" id="btn-submit">
                            Đăng ký
                        </button>
                    </div>
                </form>
            </div>
            <div class="link-register">
                Bạn đã có tài khoản? <a href="{{ route('home.login') }}"> Đăng nhập ngay</a>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            const $form = $('#form-register');
            const $inputs = $form.find('input');
            const $usernameInput = $form.find('input[name="email_or_phone"]');
            const $passwordInput = $form.find('input[name="password"]');
            const $submitBtn = $('#btn-submit');

            function handleLogin() {
                const formData = new FormData($form[0]);

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function() {
                        window.location.href = '{{ route('home.login') }}';
                    },
                    error: function(data) {
                        toast('Đăng ký không thành công', 'error');
                        $('.text-danger').text('');
                        if (data.responseJSON?.errors) {
                            Object.entries(data.responseJSON.errors).forEach(([field, messages]) => {
                                $(`.error-${field}`).text(messages[0]);
                            });
                        }
                    }
                });
            }

            // handle click button submit
            $submitBtn.on('click', function(e) {
                e.preventDefault();
                handleLogin();
            });

            // delete alert error
            $inputs.on('focus', function() {
                $('.text-danger').text('');
            });

            // move focus when pressing enter
            $usernameInput.on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    $passwordInput.focus();
                }
            });

            $passwordInput.on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    handleLogin();
                }
            });
        });
    </script>
@endpush
