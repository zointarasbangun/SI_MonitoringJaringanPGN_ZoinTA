<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title> <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <title>Sistem Monitoring Jaringan| PGNCOM</title>
    <!--
  Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}">
    <!--Iconify-->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js') }}">
    <!--
    Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!--
    Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}"> <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}"> <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange
    picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}"> <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> @yield('styles')
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .leaflet-container {
            color: 212B36;
            height: 400px;
            width: 600px;
            max-width:
                100%;
            max-height: 100%;
        }

        .sidebar-dark-primary {
            background - color: #212B36;
        }

        .sidebar-dark-primary .nav-sidebar .nav-item .nav-link.active {
            background - color: #1A232A;
        }

        .sidebar-dark-primary .nav-sidebar .nav-item .nav-link.active:hover {
            background - color: #1A232A;
        }

        .sidebar-dark-primary .nav-sidebar .nav-item .nav-link:hover {
            background - color: #1A232A;
        }

        .sidebar-dark-primary .brand-link {
            background - color: #212B36;
            border-bottom: 0;
        }

        .sidebar-dark-primary .brand-link:hover {
            background - color: #212B36;
        }
    </style> <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed ">
    <!-- navbar -->
    <nav class="container-fluid navbar navbar-expand navbar-white navbar-light ">
        @if (Auth::user()->role == 'admin')
            <ul class="ml-4 navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="{{ route('profileadmin') }}" role="button">
                        <i class="iconify nav-icon fs-4" data-icon="icon-park-outline:back"></i></a>
                </li>
            </ul>
        @elseif (Auth::user()->role == 'teknisi')
            <ul class="ml-4 navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="{{ route('profileteknisi') }}" role="button">
                        <i class="iconify nav-icon fs-4" data-icon="icon-park-outline:back"></i></a>
                </li>
            </ul>
        @else
            <ul class="ml-4 navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="{{ route('profileklien') }}" role="button">
                        <i class="iconify nav-icon fs-4" data-icon="icon-park-outline:back"></i></a>
                </li>
            </ul>
        @endif


        <ul class="navbar-nav ml-auto mr-4">
            <li class="nav-item">
                <div class="dropdown">
                    <a id="dLabel" role="button" data-toggle="dropdown" data-target="dropdown-menu" href="#">
                        <i class="iconify fs-4" data-icon="mdi:bell"></i>
                    </a>

                    <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

                        <div class="notification-heading">
                            <h4 class="menu-title">Notifications</h4>
                            <h4 class="menu-title pull-right">View all<i
                                    class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                        </div>
                        <li class="divider"></li>
                        <div class="notifications-wrapper">
                            <a class="content" href="#">

                                <div class="notification-item">
                                    <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                                    <p class="item-info">Marketing 101, Video Assignment</p>
                                </div>

                            </a>
                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                                    <p class="item-info">Marketing 101, Video Assignment</p>
                                </div>
                            </a>
                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                                    <p class="item-info">Marketing 101, Video Assignment</p>
                                </div>
                            </a>
                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                                    <p class="item-info">Marketing 101, Video Assignment</p>
                                </div>

                            </a>
                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                                    <p class="item-info">Marketing 101, Video Assignment</p>
                                </div>
                            </a>
                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">Evaluation Deadline 1 • day ago</h4>
                                    <p class="item-info">Marketing 101, Video Assignment</p>
                                </div>
                            </a>

                        </div>
                        <li class="divider"></li>
                        <div class="notification-footer">
                            <h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i>
                            </h4>
                        </div>
                    </ul>

                </div>
            </li>
        </ul>
    </nav>
    <!-- /navbar -->

    <!-- edit profil -->
    <section class="mt-3">
        <div class="container">
            <div class="container">
                <div class="row flex-lg-nowrap">
                    <div class="col">
                        <div class="row">
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        @if (Auth::user()->role == 'klien')
                                            <form
                                                action="{{ route('updateprofileklien', ['id' => Auth::user()->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                            @elseif(Auth::user()->role == 'admin')
                                                <form
                                                    action="{{ route('updateprofile', ['id' => Auth::user()->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                @else
                                                    <form
                                                        action="{{ route('updateprofileteknisi', ['id' => Auth::user()->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                        @endif
                                        <div class="e-profile">
                                            <div class="row">
                                                <div class="col-12 col-sm-auto mb-3">
                                                    <div class="mx-auto" style="width: 140px;">
                                                        <div class="d-flex justify-content-center align-items-center rounded"
                                                            style="height: 140px; background-color: rgb(233, 236, 239);">
                                                            @if (Auth::user()->image)
                                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                                    alt="User Image" class="img-fluid rounded-circle"
                                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                                            @else
                                                                <span
                                                                    style="color: rgb(166, 168, 170); font: bold 8pt Arial;">No
                                                                    image</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">
                                                        </h4>
                                                        <p class="mb-0"> </p>
                                                        <div class="mt-2">
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Change
                                                                    Photo</label>
                                                                <input type="file" class="form-control"
                                                                    id="image" name="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="text-center text-sm-right">
                                                            <span class="badge badge-secondary">administrator</span>
                                                            <div class="text-muted"><small>Joined 01 November 2023</small>
                                                            </div>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="edit-profil-tab"
                                                        data-bs-toggle="tab" data-bs-target="#edit-profil"
                                                        type="button" role="tab" aria-controls="edit-profil"
                                                        aria-selected="true">Edit
                                                        Profil</button>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <!-- form profil -->
                                                <div class="tab-pane fade show mt-3 active" id="edit-profil"
                                                    role="tabpanel" aria-labelledby="edit-profil-tab">

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Nama Klien</label>
                                                                        <input class="form-control" type="text"
                                                                            name="name"
                                                                            value=" {{ $user->name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Email Klien</label>
                                                                        <input class="form-control" type="text"
                                                                            name="email"
                                                                            value="{{ $user->email }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input class="form-control" type="password"
                                                                            name="password">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if (Auth::user()->role == 'klien')
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label>Kontak</label>
                                                                            <input class="form-control" type="number"
                                                                                name="kontak"
                                                                                value="{{ $user->kontak }}"
                                                                                placeholder="kontak">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label>Alamat</label>
                                                                            <input class="form-control" type="text"
                                                                                name="alamat"
                                                                                value="{{ $user->alamat }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="row">
                                                                <div class="col d-flex justify-content-center">
                                                                    <button class="btn btn-primary"
                                                                        type="submit">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /form profil -->
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /edit profil -->

    <script>
        document.querySelector('.hBack').addEventListener('click', function(event) {
            event.preventDefault();
            window.history.back();
        });
    </script>
</body>

</html>
