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
                Control
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.index')}}" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="side-nav-title">
                Management
            </li>
            <li class="side-nav-item">
                <a class="side-nav-link collapsed"
                data-bs-toggle="collapse"
                href="#sidebarDevice"
                aria-expanded="false"
                aria-controls="sidebarDevice" >
                    <i class="uil-desktop"></i>
                    <span>
                       Products
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDevice" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/">
                                Laptop
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Phone
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Accessories
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Category product
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a class="side-nav-link collapsed"
                data-bs-toggle="collapse"
                href="#sidebarMember"
                aria-expanded="false"
                aria-controls="sidebarDevice" >
                    <i class="u uil-users-alt"></i>
                    <span>
                        Members
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMember" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('admin.members.index')}}">
                                Administrator
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Manager
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Sales staff
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Inventory staff
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
