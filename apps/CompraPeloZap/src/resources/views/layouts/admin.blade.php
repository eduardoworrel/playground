<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $info->titulo }}'</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
 </head>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="
        height: 60px;
        background: #5739cf  !important;
    ">
            <div class="container">
                <a style='color:white'class="navbar-brand pointer fone" onclick="toggle()">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <a style="color:white;font-weight: 700"class="navbar-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <a class="navbar-link" style="color:white;font-weight: 800"href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="wrapper">
                <!-- Sidebar -->
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <div id="orangeBox" class="pointer fone" onclick="toggle();" >
                            <span id="x">X</span>
                        </div>
                        <p style="text-align: center;font-size:2em">{{$info->titulo}}</p>
                    </div>
                    <p>{{$info->subtitulo}}</p>

                    <ul class="list-unstyled components">
                        <li>
                            <a href="/home">Início</a>
                        </li>
                        <li>
                            <a href="{{route('pedido')}}">Pedidos</a>
                        </li>
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Minha Loja</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li>
                                    <a href="{{ route('personalizacaoLoja') }}">Personalizar</a>
                                </li>
                                <li>
                                    <a href="{{route('categoria')}}">Categorias</a>
                                </li>
                                <li>
                                    <a href="{{ route('produto') }}">Produto</a>
                                </li>
                                {{-- <li>
                                    <a href="{{route('cupom')}}">Cupons de Desconto</a>
                                </li> --}}
                                <li>
                                    <a href="{{route('formaEntrega')}}">Formas de Entrega</a>
                                </li>
                                <li>
                                    <a href="{{route('formaPagamento')}}" >Formas de Pagamento</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </nav>
                <!-- Page Content -->
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
