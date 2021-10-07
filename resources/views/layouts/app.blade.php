<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body style="background-color: rgb(231, 231, 231)">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="col-4">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                   
                    <div><img src="/logo/feather.png" style="max-height: 25px; pl-50" class="pr-1"></div>
                        <div class="pl-2 pt-1" style="border-left: 1px solid; font-family: 'Brush Script MT', cursive;">Pictus</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                </div>
                @if(Auth::user())
                <div class="col-4">
                    <form action="{{route('search.users')}}" method="GET">
                        <div class="input-group rounded">
                            <input type="name" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" required/>
                            
                            <button class="input-group-text border-0" type="submit">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                        </form>
                </div>
                @endif
                <div class="collapse navbar-collapse col-4" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <div  style="padding-top:12px">
                            <a href="/" class="text-dark">
                            <i class="fas fa-home fa-lg pt-1"></i>
                            </a>
                        </div>
                        <li class="nav-item dropdown no-arrow mx-1" id="markAsRead" onclick="markNotificationOnRead()" style="padding-top:5px">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-lg text-dark"></i>
                                <!-- Counter - Alerts -->
                                
                                <span class="badge badge-danger badge-counter">{{count(auth()->user()->unreadNotifications)}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Obavestenja:
                                </h6>

                               
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        <a class="dropdown-item d-flex align-items-center" href="{{route('post.show', $notification->data['post']['id'])}}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="medium text-gray-1000">
                                                    <strong>{{$notification->data['user']['name']}}</strong> je komentarisao vasu objavu
                                                </div>
                                                <span class="font-weight-bold"></span>
                                            </div>
                                        </a>
                                        @empty
                                        <h6 class="dropdown-header text-dark">
                                             Nemate obavestenja 
                                        </h6>
                                            
                                        
                                    @endforelse
                                 

                                
                            </div>
                        </li>
                       
                            <li class="nav-item dropdown">
                                
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{auth()->user()->profile->profileImage()}}" class="rounded-circle w-100" style="max-width: 30px">
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile/{{auth()->user()->profile->id}}"><img src="{{auth()->user()->profile->profileImage()}}" 
                                        class="rounded-circle w-100" style="max-width: 30px"><span class="text-dark pl-2">{{auth()->user()->username}}</span></a>
                                    <hr>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Odjavi se') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
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
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>
    
    <script>
        function markNotificationOnRead(){
            $.get('/markAsRead');
        }
    </script>

</html>
