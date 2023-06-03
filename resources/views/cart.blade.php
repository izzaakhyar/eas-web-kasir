<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kasir</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    

</head>
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/list" style="align-content: center;">Kasir</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Center of Navbar -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <div class="input-group rounded">
                        <form action="/list" method="get">
                        <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        </form>
                        
                            <i class="bi bi-search input-group-text border-0"></i>
                        
                    </div>
                </li>
            </ul>



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
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>

                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="balance dropdown-item">
                              <p style="margin-bottom:0"><strong><i class="bi bi-wallet2"> Balance</i></strong><br>Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</p>
                            </div>
                            <!-- Dropdown Items -->
                            <a class="dropdown-item" href="/cart"><i class="bi bi-cart3"></i> Keranjang</a>
                            <!-- <a class="dropdown-item" href="#">Item 2</a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:red"><i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}</a>
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
</div>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 60vh;">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start">
                <a href="/list" class="btn btn-light"><i class="bi bi-arrow-left"></i> Continue shopping</a>
                </div>
                <div class="d-flex justify-content-end mr-0">Your Account Balance: Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</div>
            </div>
            
            
            <hr>
            
            <div class="card h-100">
                <div class="card-header">Keranjang</div>
                <div class="card-body">
                    @if ($carts->isEmpty())
                        <p>Keranjang Anda kosong.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/products/' . $cart->product->image_url) }}" alt="{{ $cart->product->name }}" class="img-thumbnail" style="max-width: 100px;">
                                            </td>
                                            <td>{{ $cart->product->name }}</td>
                                            <td>
                                                <button onclick="decreaseQuantity({{ $cart->product->id }})"><i class="bi bi-dash-square"></i></button>
                                                <span id="quantity_{{ $cart->product->id }}">{{ $cart->quantity }}</span>
                                                <button onclick="increaseQuantity({{ $cart->product->id }})"><i class="bi bi-plus-square"></i></button>
                                            </td>
                                            <td id="price_{{ $cart->product->id }}">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                            <td id="totalPrice_{{ $cart->product->id }}">Rp {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="/cart/{{ $cart->product->id }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
  <td colspan="4"><strong>Total:</strong></td>
  <td colspan="2" id="totalAmount"><strong>Rp {{ number_format($totalAmount, 0, ',', '.') }}</strong></td>
</tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                        @if ($totalAmount > Auth::user()->balance)
                        
                            <div class="text d-flex justify-content-start" style="margin-right: 10px;">
                                <a href="/checkout" class="btn btn-secondary" title="Klik untuk melakukan checkout">
                                    <i class="bi bi-cash-stack"></i> Top Up Saldo
                                </a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="/cart" class="btn btn-primary" style="cursor: not-allowed;" title="Klik untuk melakukan checkout" 
                                onclick="return confirm('Anda tidak memiliki cukup saldo. Silahkan top up dulu')">
                                    <i class="bi bi-cash-stack"></i> Checkout
                                </a>
                            </div>
                        
                        
                        @else 
                        
                        <div class="text d-flex justify-content-start" style="margin-right: 10px;">
                                <a href="/checkout" class="btn btn-secondary" title="Klik untuk melakukan checkout">
                                    <i class="bi bi-cash-stack"></i> Top Up Saldo
                                </a>
                            </div>
                            <form action="/checkout" method="post">
                                @csrf
                                
                        <div class="text d-flex justify-content-end" style="margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cash-stack"></i> Checkout
                            </button>
                        </div>
                        </form>
                        @endif
                        </div>

                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>