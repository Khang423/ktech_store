<div class="leftside-menu">
    <a href="{{ env('APP_URL') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('asset/admin/systemImage/KtechLogo.png') }}" alt="Hytertech" style="width: 50px;height: 50px">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('asset/admin/systemImage/KtechLogo.png') }}" alt="Hytertech" style="height:30px;width:30px">
        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <ul class="side-nav">
            <li class="side-nav-title">
                Control
            </li>
            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
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
                <a class="side-nav-link collapsed" data-bs-toggle="collapse" href="#sidebarDevice" aria-expanded="false"
                    aria-controls="sidebarDevice">
                    <i class="uil-desktop"></i>
                    <span>
                        Products
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDevice" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.products.index') }}">
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
                            <a href="{{ route('admin.categoryProducts.index') }}">
                                Category product
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.members.index') }}" class="side-nav-link">
                    <i class="u uil-users-alt"></i>
                    <span>
                        Members
                    </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a class="side-nav-link collapsed" data-bs-toggle="collapse" href="#sidebarRoles" aria-expanded="false"
                    aria-controls="sidebarDevice">
                    <i class="uil-label"></i>
                    <span>
                        Roles
                    </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarRoles" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/">
                                Permissions
                            </a>
                        </li>
                        <li>
                            <a href="/">
                                Member Role
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.suppliers.index') }}" class="side-nav-link">
                    <i class="uil-truck"> </i>
                    <span>
                        Suplliers
                    </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('admin.brands.index') }}" class="side-nav-link">
                    <i class="uil-circuit"></i>
                    <span>
                        Brands
                    </span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
