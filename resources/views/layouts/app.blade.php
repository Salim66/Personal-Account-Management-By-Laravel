<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}

    <!-- Select2 -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <!-- Bootstarp Datepicker -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}" />
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.bootstrap5.min.css') }}"/>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom -->
    <link rel="stylesheet" href="css/custom.css">


    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
    <style type="text/css">
        .notifyjs-corner {
            z-index: 10000 !important;
        }
    </style>
    <!-- Sweetalert -->
    <script src="{{asset('/sweetalert/sweetalert.js')}}"></script>
    <link href="{{asset('/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />

</head>
<body>
    <div id="app">


        <main class="py-4">
            @yield('content')
        </main>



        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg" style="position: fixed; bottom: 0; width: 100%; z-index: 10000;">
            <div class="container">
                <a class="navbar-brand navbar-barnd__item" href="{{ url('/home') }}">
                    <i class="fa fa-home text-primary"></i><br>
                    <span class="text-uppercase">Home</span>
                </a>
                <a class="navbar-brand navbar-barnd__item" href="{{ url('/income') }}">
                    <i class="fa fa-money text-primary" aria-hidden="true"></i><br>
                    <span class="text-uppercase">Income</span>
                </a>
                <a class="navbar-brand navbar-barnd__item" href="{{ url('/expense') }}">
                    <i class="fa fa-minus-circle text-primary"></i><br>
                    <span class="text-uppercase">Expense</span>
                </a>
                <a class="navbar-brand navbar-barnd__item" href="{{ url('/profit') }}">
                    <i class="fa fa-product-hunt text-primary"></i><br>
                    <span class="text-uppercase">Profit</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </nav>

    </div>

    <!-- Script JS -->


    <!-- Select2 -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Bootstarp Datepicker -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" ></script>
    <!-- Notify Js -->
    <Script src="js/notify.js"></Script>
    <!-- Datatable -->
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.colVis.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="js/custom.js"></script>

</body>
</html>
