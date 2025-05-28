<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-start">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm" style='font-size:24px'>
                            <img src="{{ asset('assets/images/Simlurah Icon Black.svg') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg" style='font-size:24px'>
                            <img src="{{ asset('assets/images/Simlurah Color.svg') }}" alt="" height="40">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/Simlurah Icon White.svg') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/Simlurah White Color.svg') }}" alt="" height="40">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="btn btn-sm px-3 font-size-24 d-lg-none header-item waves-effect waves-light"
                    data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>

            <div class="float-end">

                <!-- App Search-->
                <form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="fa fa-search"></span>
                    </div>
                </form>


                <div class="dropdown d-none d-lg-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen font-size-24"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="dropdown d-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="m-0"> Notifications (258) </h5>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="javascript:void(0);" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                        <span class="avatar-title border-success rounded-circle ">
                                            <i class="mdi mdi-cart-outline"></i>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your order is placed</h6>
                                        <div class="text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
    
                            <a href="javascript:void(0);" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                        <span class="avatar-title border-warning rounded-circle ">
                                            <i class="mdi mdi-message"></i>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">New Message received</h6>
                                        <div class="text-muted">
                                            <p class="mb-1">You have 87 unread messages</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
    
                            <a href="javascript:void(0);" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                        <span class="avatar-title border-info rounded-circle ">
                                            <i class="mdi mdi-glass-cocktail"></i>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your item is shipped</h6>
                                        <div class="text-muted">
                                            <p class="mb-1">It is a long established fact that a reader will</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
    
                            <a href="javascript:void(0);" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                        <span class="avatar-title border-primary rounded-circle ">
                                            <i class="mdi mdi-cart-outline"></i>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your order is placed</h6>
                                        <div class="text-muted">
                                            <p class="mb-1">Dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
    
                            <a href="javascript:void(0);" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                        <span class="avatar-title border-warning rounded-circle ">
                                            <i class="mdi mdi-message"></i>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">New Message received</h6>
                                        <div class="text-muted">
                                            <p class="mb-1">You have 87 unread messages</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 w-100 text-center" href="javascript:void(0)">
                                View all
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="assets/images/users/user-4.jpg"
                            alt="Header Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i>
                            Profile</a>
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-wallet font-size-17 text-muted align-middle me-1"></i> My
                            Wallet</a>
                            <a class="dropdown-item d-flex align-items-center" href="#"><i class="mdi mdi-cog font-size-17 text-muted align-middle me-1"></i> Settings<span class="badge bg-success ms-auto">11</span></a>
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-lock-open-outline font-size-17 text-muted align-middle me-1"></i>
                            Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#"><i
                                class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i>
                            Logout</a>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-spin mdi-cog"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="top-navigation">
        <div class="page-title-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h1 style="color:white">Retribusi Sampah</h1>
                            {{-- <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Lexa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Horizontal</a></li>
                                <li class="breadcrumb-item active">Horizontal</li>
                            </ol> --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="state-information d-none d-sm-block">
                            <div class="state-graph float-end">
                                <div id="header-chart-1" data-colors='["--bs-primary"]'></div>
                                <!-- <div class="info">Balance $ 2,317</div> -->
                            </div>
                            <div class="state-graph">
                                <div id="header-chart-2" data-colors='["--bs-info"]'></div>
                                <!-- <div class="info">Item Sold 1,230</div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>

        <div class="container-fluid">
            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            @if(isset($menuTree))
                                @include('layouts.menu-item', ['menus' => $menuTree])
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
    $(document).on("click", "#menu-logout", function(e) {
        e.preventDefault();
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('logout') }}",
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                window.location.href = "{{ route('login') }}";
            },
            error: function(error) {
                window.location.href = "{{ route('login') }}";
            }
        });
    });
</script>