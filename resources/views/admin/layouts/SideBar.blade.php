<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('Admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            Super {{ Auth::check() ? Auth::user()->role : redirect('login') }}
        </span>
        <span class="brand-text font-weight-light">
            {{ config('app.name') }}
        </span>

    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('Admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</a>
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('Admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">
                    Super {{ Auth::check() ? Auth::user()->role : redirect('login') }}
                </span>
                <span class="brand-text font-weight-light">
                    {{ config('app.name') }}
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="height: calc(100vh - 57px); overflow-y: auto; overflow-x: hidden;">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('Admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Display Registered user</p>
                            </a>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="{{ route('platforms.create') }}" class="nav-link active">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>Add Platform</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('platforms.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>Display Platforms</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('posts.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Display Posts</p>
                            </a>
                        </li>




                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ config('app.name') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @include('Admin.layouts.AdminHeader')
    <!-- /.content -->
</div>
