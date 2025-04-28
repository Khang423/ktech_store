<div class="leftside-menu">
    <a href="{{ env('APP_URL') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('asset/admin/systemImage/laravel.png') }}" alt="Hytertech" style="width: 40px;height: 40px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('asset/admin/systemImage/laravel.png') }}" alt="Hytertech" style="height:30px;width:30px">
        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <ul class="side-nav">
            <li class="side-nav-title">
                Điều khiển
            </li>
            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span>
                        Bản điều khiển
                    </span>
                </a>
            </li>

            <li class="side-nav-title">
                Thành phần
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarService" aria-expanded="false" aria-controls="sidebarService"
                    class="side-nav-link collapsed">
                    <i class="uil-wifi"></i>
                    <span>
                        Quản lý Internet
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarService" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="">
                                Gói cước
                            </a>
                        </li>
                        <li>
                            <a href="">
                                FPT Could
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Loại gói cước
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="uil-wifi-router"></i>
                    <span>
                        Quản lý Thiết Bị
                    </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="uil-ticket"></i>
                    <span>
                        Khuyến mãi
                    </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="uil uil-newspaper"></i>
                    <span>
                        Tin tức
                    </span>
                </a>
            </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sibarMember" aria-expanded="false" aria-controls="sibarMember"
                        class="side-nav-link collapsed">
                        <i class=" uil-user"></i>
                        <span>
                            Quản lý Tài Khoản
                        </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="sibarMember" style="">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="">
                                    Danh sách tài khoản
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    Vai trò
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            <li class="side-nav-item">
                <a href="" class="side-nav-link">
                    <i class="uil-phone-alt"></i>
                    <span>
                        Liên Hệ
                    </span>
                </a>
            </li>

            <li class="side-nav-title">
                Hệ thống
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sibarConfig" aria-expanded="false" aria-controls="sibarConfig"
                    class="side-nav-link collapsed">
                    <i class=" uil-cog"></i>
                    <span>
                        Cấu hình
                    </span>
                    <span class="menu-arrow"></span>
                </a>

                <div class="collapse" id="sibarConfig" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="">
                                Cấu hình hệ thống
                            </a>
                        </li>
                            <li>
                                <a href="">
                                    Danh sách chặn
                                </a>
                            </li>
                        <li>
                            <a href="">Ảnh nền Page Home</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
