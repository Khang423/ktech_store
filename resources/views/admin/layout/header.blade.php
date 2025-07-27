<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>


        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-line font-22"></i>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                    aria-label="Theme Mode" data-bs-original-title="Theme Mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>

            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line font-22"></i>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ asset('asset/admin/members/') }}/{{ Auth::user()->avatar }}" width="45"
                            height="45" class="rounded-circle">
                    </span>
                    <span class="text-dark d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0">
                            {{ Auth::user()->name }}
                        </h5>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Xin chào!</h6>
                    </div>
                    <a class="dropdown-item">
                        {{-- href="{{ route('admin.members.edit', Auth::user()) }}" --}}
                        <i class="uil-user-circle me-1"></i>
                        <span>
                            Tài khoản của tôi
                        </span>
                    </a>
                    <a class="dropdown-item">
                        {{-- href="{{ route('admin.members.edit', Auth::user()) }}" --}}
                        <i class="uil uil-padlock"></i>
                        <span>
                            Đổi mật khẩu
                        </span>
                    </a>

                    <a href="{{ route('admin.logout') }}">
                        <button type="submit" class="logout dropdown-item">
                            <i class="uil-sign-out-alt me-1"></i>
                            Đăng xuất
                        </button>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
