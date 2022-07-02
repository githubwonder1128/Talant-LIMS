<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Besicon Project</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
    rel="stylesheet"
    />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.material.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.material.min.css" rel="stylesheet"/>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2014-11-29/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.1/xlsx.full.min.js"></script>
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        function toastFunction() {
            let x = document.getElementById("toast")
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    </script>
    <style>
    /* #table_projectsummary_wrapper{
        width: 100%;
    } */
    td,th{
        /* padding: 0px!important; */
        text-align: center;
    }
    #toast {
        visibility: hidden;
        min-width: 250px;
        background-color: green;
        color: #fff;
        padding: 16px;
        position: fixed;
        z-index: 1;
        right: 20px;
        bottom: 0%;
    }

    #toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 0%; opacity: 1;}
    }

    @keyframes fadeout {
        from {bottom: 80%; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>
</head>
<body>
    <div id="toast">
     Success!
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                        @else
                            @if(Auth::user()->name == 'Besicon')
                            
                            
                         <img src="https://besicon.my/wp-content/uploads/2021/11/besicon-main-logo-2.png" width="150" height="70"/>
                     
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="{{ url('home')}}" style="font-size:20px;color:#0000FF;font-weight:bold">Project Summary<br>
  项目总结</a>

                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href=" {{ url('details')}} " style="font-size:20px;color:#0000FF;font-weight:bold">Project Details<br>项目详情</a>

                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="btn btn-primary dropdown-toggle"
                                        href="#"
                                        role="button"
                                        id="dropdownMenuLink"
                                        data-mdb-toggle="dropdown"
                                        aria-expanded="false" 
                                        style="font-size:20px;color:#0000FF;font-weight:bold">Man Power<br>场地工人</a>
                                    <ul class="dropdown-menu" aria-labelledby="page-manpower">
                                        <li><a class="dropdown-item" href="{{ url('/manpower/worker')}}">Site Worker</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/manpower/facworker')}}">Factory Worker</a></li>
                                    </ul>
                                </div>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href=" {{ url('project_progress')}}" style="font-size:20px;color:#0000FF;font-weight:bold">Project Progress<br>项目进展</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href=" {{ url('drawing')}}" style="font-size:20px;color:#0000FF;font-weight:bold">Drawing<br>绘图</a>

                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href=" {{ url('gallery')}}" style="font-size:20px;color:#0000FF;font-weight:bold">Gallery<br>场地照片</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href=" {{ url('report')}}" style="font-size:20px;color:#0000FF;font-weight:bold">Report<br>报告</a>

                            </li>
                            @elseif(Auth::user()->name == 'fab')
                                <li class="nav-item">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('/fabribation_readonly')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Fabrication Department</a>

                                </li>
                            @elseif(Auth::user()->name == 'fac')
                                <li class="nav-item" style="margin-top : 10px">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('facworker_readonly/home')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Factory Worker</a>

                                </li>
                                <li class="nav-item" style="margin-top : 10px">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('facworker_readonly/saverecords')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Saved Record</a>

                                </li>
                                <li class="nav-item" style="margin-top : 10px">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('facworker_readonly/report')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Report</a>

                                </li>
                            @elseif(Auth::user()->name == 'mat')
                                <li class="nav-item" style="margin-top : 10px">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('material/addmaterial')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Add Material</a>

                                </li>
                                <li class="nav-item" style="margin-top : 10px">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('material/records')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Saved Record</a>

                                </li>
                                <li class="nav-item" style="margin-top : 10px">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('material/reports')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Report</a>

                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link  btn btn-primary" href=" {{ url('manpower_readonly')}}"  style="font-size:20px;color:#0000FF;font-weight:bold">Man Power</a>

                                </li>
                                
                            @endif
                        @endguest
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav " style="margin-top : 5px">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button
                                    class="btn btn-primary dropdown-toggle"
                                    type="button"
                                    id="dropdownMenuButton"
                                    data-mdb-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"
></script>

</html>
