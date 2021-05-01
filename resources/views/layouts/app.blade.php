<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Projeto Lab.Prog.')</title>

    <!-- Scripts -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    @yield('scripts')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    
<!-- <?php /* if (!session()->has("cart")) {

        //check for a cookie
        $cart = Cookie::get('cart');

        if($cart) session()->put("search", json_decode($cart));
        else {
             $search = new stdClass();
             $search->language = "any";
             $search->category = "any";
             Session::put("cart", $cart);
        }

}*/
?> -->
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img width="35px" src="{{URL::to('/logo1.png')}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos')}}">Todos os Produtos </a>
                          </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos/bebidas')}}">Bebida </a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos/comida')}}">Comida </a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos/crianca')}}">Criança </a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos/eletrodomesticos')}}">Eletrodomésticos</a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos/higiene')}}">Higiene</a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link" href="{{url('/produtos/vestuario-calcado')}}">Vestuário/Calçado </a>
                          </li>
                          @guest

                    @else 
                    @if (Auth::user()->role == "Admin")
                    
                          <li class="nav-item active">
                              <a href="{{url('/produtos/create')}}" class="btn btn-info ml-5" style="border-radius: 20px"><i class="fa fa-plus"></i> Add Produtos</a>
                          </li>
                
                    
                    @endif

                    @endguest
                    </ul>
                    

                    <!-- Middle of Navbar -->
                    <form action={{url('/search')}} method="get" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="search" class="form-control" style="border-radius: 20px; margin-left: -40px" name="q" placeholder="Procure um produto..."> 
                                <button type="submit" class="btn btn-default rounded-circle" >
                                    <i class="fa fa-search " ></i>
                                </button>
                        </div>
                    </form>

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

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 main-section">
                                    <div class="dropdown">
                                        <button type="button" style="border-radius: 20px; " class="btn btn-info" data-toggle="dropdown">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrinho <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="row total-header-section">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                                </div>
                                                <?php $total = 0 ?>
                                                @foreach((array) session('cart') as $id => $details)
                                                    <?php $total += $details['preco'] * $details['quantidade'] ?>
                                                @endforeach
                                                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                                    <p>Total: <span class="text-info"> {{ $total }}€</span></p>
                                                </div>
                                            </div>
                                            @if(session('cart'))
                                                @foreach(session('cart') as $id => $details)
                                                    <div class="row cart-detail">
                                                        
                                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                            <p>{{ $details['nome'] }}</p>
                                                            <span class="price text-info"> {{ $details['preco'] }}€</span> <span class="count"> Quantity:{{ $details['quantidade'] }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                    <a href="{{ url('produtos/cart') }}" class="btn btn-primary btn-block "style="border-radius: 20px;">View all</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <li class="nav-item dropdown" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle shadow" style="border-radius: 20px; border-color: gray"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user"></i>  Olá, {{ Auth::user()->name }} 
                                </a>
                                @if (Auth::user()->role == "Admin")
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-secondary" href="{{ url('admin') }}">Painel de Controlo</a>
                                
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @else
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-secondary" href="{{ url('users/perfil') }}">Perfil</a>

                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endif
                                
                               
                                
                                
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            
        </nav>

        <main class="container">
            @yield('content')
        </main>

        

        <footer class="container">
    
            <p>&copy; 2020 Company, Inc. &middot; <a class="text-muted" href="{{url('/team')}}">Team</a> &middot; <a class="text-muted" href="{{url('/about')}}">AboutUs</a></p>
          </footer>

          @yield('scripts2')
    </div>
</body>
</html>
