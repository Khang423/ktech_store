<!DOCTYPE html>
<html lang="en" data-layout="topnav">

<head>
    <meta charset="utf-8"/>
    <title>Login | K-Tech Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/admin/systemImage/laravel.png') }}">
    {{-- App Css --}}
    <link href="{{ asset('css/admin/hyper/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    {{-- Icon Css --}}
    <link href="{{ asset('css/admin/hyper/icons.min.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="authentication-bg position-relative">
<div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
    <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
        <g fill-opacity='0.22'>
            <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600'/>
            <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500'/>
            <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300'/>
            <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200'/>
            <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100'/>
        </g>
    </svg>
</div>
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <!-- Logo -->
                    <div class="card-header py-4 text-center bg-primary">
                        <a href="index.html">
                                <span><img src="{{ asset('asset/admin/systemImage/KtechLogo.png') }}" alt="logo"
                                           height="50"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                            <p class="text-muted mb-4">Enter your email address and password to access admin panel.
                            </p>
                        </div>

                        <form action="{{ route('admin.login') }}" method="post" id="form-login">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                           name="email_or_phone" placeholder="name@example.com of number phone"/>
                                    <label for="floatingInput">Email or Number phone</label>
                                    <div class="text-danger mt-1 error-email_or_phone"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password"
                                           id="floatingPassword" placeholder="Password"/>
                                    <label for="floatingPassword">Password</label>
                                    <div class="text-danger mt-1 error-password"></div>
                                </div>
                            </div>

                            <div class="mb-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="checkbox-signin"
                                           checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="button" id="login-submit"> Log In</button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    <script>
        document.write(new Date().getFullYear())
    </script>
    © K-Tech
</footer>
{{-- Jquery --}}
<script src="{{ asset('js/libraries/jquery/jquery.min.js') }}"></script>
{{-- Config js --}}
<script src="{{ asset('js/admin/hyper/hyper-config.js') }}"></script>
{{-- Vendor js --}}
<script src="{{ asset('js/admin/hyper/vendor.min.js') }}"></script>
{{-- App js --}}
<script src="{{ asset('js/admin/hyper/app.min.js') }}"></script>
<script src="{{ asset('js/libraries/sweetalert/sweetalert2.js') }}"></script>
<script src="{{ asset('js/libraries/sweetalert/confirm_toast.js') }}"></script>
<script src="{{ asset('js/libraries/sweetalert/confirm_alert.js') }}"></script>
<script>
    $(document).ready(function () {
        // init
        const $form = $('#form-login');
        const $inputs = $form.find('input');
        const $usernameInput = $form.find('input[name="email_or_phone"]');
        const $passwordInput = $form.find('input[name="password"]');
        const $submitBtn = $('#login-submit');

        function handleLogin() {
            const formData = new FormData($form[0]);

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function () {
                    window.location.href = '{{ route('admin.dashboard') }}';
                },
                error: function (data) {
                    toast('Đăng nhập thất bại', 'error');
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
        $submitBtn.on('click', function (e) {
            e.preventDefault();
            handleLogin();
        });

        // delete alert error
        $inputs.on('focus', function () {
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
</body>

</html>
