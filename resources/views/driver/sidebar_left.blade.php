

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{route('image',['url'=>$company_logo,'width'=>34,'height'=>34])}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{$company_name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @php($avatar = (Auth::user()->profiles()->where('key', 'avatar')->first())?Auth::user()->profiles()->where('key', 'avatar')->first()->value:1)
                <img src="{{route('image',['url'=>$avatar,'width'=>34,'height'=>34])}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('driver')}}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('admin')}}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Orders
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-sticky-note nav-icon"></i>
                                <p>All Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-angle-double-left nav-icon"></i>
                                <p>Check In</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Check Out</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-money-bill-wave nav-icon"></i>
                                <p>Bill Pay</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>
                            Notices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-sticky-note nav-icon"></i>
                                <p>All Notices</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Transection
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-money-bill nav-icon"></i>
                                <p>All Transection</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Branches
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fas fa-sitemap nav-icon"></i>
                                <p>All Branches</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ (request()->is('admin/merchants*')) ? 'menu-open' : '' }}">
                    <a href="{{route('admin.merchants')}}" class="nav-link {{ (request()->is('admin/merchants*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Merchants
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.merchants')}}" class="nav-link {{ (request()->is('admin/merchants')) ? 'active' : '' }}">
                                <i class="far fas fa-users nav-icon"></i>
                                <p>All Merchants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.merchants.register')}}" class="nav-link {{ (request()->is('admin/merchants/register')) ? 'active' : '' }}">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ (request()->is('admin/drivers*')) ? 'menu-open' : '' }}">
                    <a href="{{route('admin.drivers')}}" class="nav-link {{ (request()->is('admin/drivers*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Drivers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.drivers')}}" class="nav-link {{ (request()->is('admin/drivers')) ? 'active' : '' }}">
                                <i class="fas fa-truck nav-icon"></i>
                                <p>All Drivers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.drivers.register')}}" class="nav-link {{ (request()->is('admin/drivers/register')) ? 'active' : '' }}">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/profile*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/profile*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.profile.general')}}" class="nav-link {{ (request()->is('admin/profile/general')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.profile.changepassword')}}" class="nav-link {{ (request()->is('admin/profile/changePassword')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>