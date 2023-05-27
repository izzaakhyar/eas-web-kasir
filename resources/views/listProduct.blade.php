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
    <style>
    body {
        background-color: #202123;
    }
    .card {
    color: black;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
  }
.card:hover {
    /* box-shadow: 0 0 25px rgba(0, 0, 0, 0.3); */
    transform: translateY(-2px);
    transition-duration: 0.2s;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 10px 0px,
    rgba(0, 0, 0, 0.5) 0px 2px 25px 0px;
    border-color: red;
    
  }
  .card::before {
    background: #40E0D0;
background: -webkit-linear-gradient(to right, #FF0080, #FF8C00, #40E0D0);
background: linear-gradient(to right, #FF0080, #FF8C00, #40E0D0);
  animation: glowing01 5s linear infinite;
  transform-origin: center;
  animation: glowing 5s linear infinite;
  }
  @keyframes glowing {
  0% {
    transform: rotate(0);
  }
  100% {
    transform: rotate(360deg);
  }
}
  .card-link {
    color: black;
    text-decoration: none;
  }
  .card-link:hover {
    color: black;
    text-decoration: none;
  }

  .modal-dialog {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: calc(100vh - 60px); /* Menggunakan 60px jika ada navbar di atas modal */
}

  .modal-content {
  border-radius: 5%;
  max-width: 90%;
  
}

.modal-header {
  border-top-left-radius: 5%;
  border-top-right-radius: 5%;
}


.modal-footer {
  border-bottom-left-radius: 5%;
  border-bottom-right-radius: 5%;
}

    .btn-secondary {
        position: relative;
    }

    .btn-secondary .hover-text {
        display: none; /* Menghilangkan tampilan tulisan secara default */
        transition: opacity 0.3s;
    }

    .btn-secondary:hover .hover-text {
        display: inline;
        width: 120px;
    } 
</style>

<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/listproduct') }}" style="align-content: center;">Kasir</a>
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
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="bi bi-search"></i>
                        </span>
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
                            <!-- Dropdown Items -->
                            <a class="dropdown-item" href="#"><i class="bi bi-cart3"></i> Keranjang</a>
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

    

    <div class="container-fluid">
    <!-- <div class="d-flex justify-content-end">
        <a class="btn btn-primary mb-2" href="/checkout">Riwayat Transaksi</a>
        <a class="btn btn-primary mb-2" href="/create">Tambah Produk</a>
    </div> -->
    <div class="d-flex justify-content-between">
  <div>
    <a class="btn btn-secondary mb-2 mr-auto" href="/create" style="margin-top:8px"><i class="bi bi-plus-square"></i><span class="hover-text"> <i>Tambah Produk</i></span></a>
  </div>
  <div>
    <a class="btn btn-secondary mb-2 ml-auto" href="/checkout" style="margin-top:8px"><i class="bi bi-receipt"></i><span class="hover-text"> <i>Riwayat Transaksi</i></span></a>
  </div>
</div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <a href="/detail/{{$product->id}}" class="card-link" data-toggle="modal" data-target="#myModal{{$product->id}}">
                <div class="card h-100" style="border-radius: 5%; background-color: #f8f8f6">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center mb-3">
                            @if (strlen($product->image_url) > 0)
                                <img src="{{ asset('storage/products/' . $product->image_url) }}" alt="{{ $product->name }}" style="max-height: 200px; width: 500px" class="img-fluid">
                            @else
                                <span class="text-muted">Gambar tidak tersedia</span>
                            @endif
                        </div>
                        <div class="mb-3">
                        <!-- @if (strlen($product->image_url) > 0)
                                <img src="{{ asset('storage/products/' . $product->image_url) }}" alt="{{ $product->name }}" style="max-height: 200px" class="img-fluid">
                            @else
                                <span class="text-muted">Gambar tidak tersedia</span>
                            @endif
                            <br> -->
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <!-- <p class="card-text">{{ $product->description }}</p> -->
                            <p class="card-text"><small class="text-muted">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</small></p>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary btn-outline-light btn-block">Beli</a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

        @foreach ($products as $product)
        <div class="modal fade" id="myModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{$product->name}}  <a href="/product/{{$product->id}}/edit" style="color:gray"><i class="bi bi-pencil-square"></i></a></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img src="{{ asset('storage/products/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-fluid">                 
          </div>
          <div class="col-md-6">
            <p><strong>{{$product->name}}</strong></p>
            <p><strong>Deskripsi:</strong></p>
            <p>{{$product->description}}</p>
            
            <p><strong>Stok:</strong> {{ $product->stock }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($product->price) }}</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <a href="/product/{{$product->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm
                        ('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
        <form action="/cart/add/{{$product->id}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
        </button>
    </form>
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="/cart/add/{{$product->id}}" class="btn btn-primary"><i class="bi bi-cart-plus"></i></a> -->
      </div>
    </div>
  </div>
</div>
@endforeach
    </div>
</div> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>