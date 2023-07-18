<aside class="main-sidebar sidebar-dark-primary elevation-5">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('front/img/logo-icon.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Junk</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users.edit', auth()->user()->id) }}"
                    class="d-block">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2" style="font-size: 14px;">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{-- <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new user</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('web_index_coaches') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coaches</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_create_coach_view') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new coach</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-square"></i>
                        <p>
                            Class Creation
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('classes.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('classes.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create new class</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Schedule Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sessions.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sessions.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_attend_member_to_session_view') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_generate_session_daily_qrcode_view') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Class QRL</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_get_completed_sessions') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Completed Classes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_get_uncompleted_sessions1') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Uncompleted Classes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-headphones"></i>
                        <p>
                            Genre Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('musics.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Genres</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('musics.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Genre</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Membership Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('packages.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Membership Bios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('packages.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Membership</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Sales Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('web_view_expiration_of_purchase') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('web_get_fees') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fees</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('back_calander_data_show') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Class Schedule
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('payment', ['id' => 1]) }}" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Payment settings
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('web_get_orders_info') }}" class="nav-link">
                                <i class="nav-icon fas fas fa-newspaper"></i>
                                <p>
                                    Orders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_list_service_rates') }}" class="nav-link">
                                <i class="nav-icon fas fas fa-newspaper"></i>
                                <p>
                                    Rates
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_view_users_data_table') }}" class="nav-link">
                                <i class="nav-icon fas fas fa-newspaper"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('web_view_coaches_data_table') }}" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Coaches
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
