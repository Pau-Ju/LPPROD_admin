<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="LPProdSéries">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LP Prod Séries</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}"/>



    <!--Feuilles CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')


</head>

<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <!--Nom du site-->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- ('app.name', 'Laravel') --}}
                    <img src="{{asset('favicon.PNG')}}" class="img-responsive">
                </a>
            </div>
            <!--Contenu de la navBar-->
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!--A gauche-->
                <ul class="nav navbar-nav navbar-left">
                    <li class="nav-item "><a  href="{{ url('/top') }}"> Top séries </a></li>
                    <li class="nav-item "><a  href="{{ url('/series/create') }}"> Ajout d'une série </a></li>


                </ul>


                <div class=" nav-item col-sm-3 col-md-3">
                    @include('search')
                </div>

                <!--A droite-->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item "><a href="{{ route('login') }}">
                                <i class="fa fa-user-circle-o fa-2x" style="color: cornflowerblue" aria-hidden="true"></i>
                            </a>
                        </li>
                    @else
                        <li class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" style="color: cornflowerblue" >
                                    Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    @if(session('success'))
        <div class="container">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif
</div>

@yield('content')




@include('footer')
</body>
</html>