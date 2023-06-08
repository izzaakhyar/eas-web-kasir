<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link rel="shortcut icon" href="{{ asset('gambar/Logo-GameVerse.png') }}"> -->
    <title>GameVerse</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="{{ URL::asset('css/coba.css') }}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<nav class="navbar navbar-expand-md shadow-sm" style="background-color: #2b1b4d">
        <div class="container">
            <a class="navbar-brand" href="/list" style="align-content: center;"><img src="gambar/Logo-GameVerse.png"
            class="img-fluid" alt="Sample image" style="width: 40px; height: 40px"></a>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fad85d" v-pre>
                            <img src="{{ asset('storage/products/' . Auth::user()->avatar) }}" alt="Profil {{ Auth::user()->name }}" class="img-fluid" style="width: 32px; height: 32px; border-radius: 50%"> 
                                {{ Auth::user()->name }}
                            </a>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width:300px">
                                <div class="balance dropdown-item">
                                    <p style="margin-bottom:0"><strong><i class="bi bi-controller"></i> Games</i></strong></p>
                                    <small style="margin-left:23px">0 Games Owned</small>
                                </div>
                                <div class="balance dropdown-item">
                                    <p style="margin-bottom:0"><strong><i class="bi bi-wallet2"> Balance</i></strong></p>
                                    <small style="margin-left:23px">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</small>
                                </div>
                                <div class="balance dropdown-item">
                                    <a href="/history" style="text-decoration: none">
                                        <p style="margin-bottom:0"><strong><i class="bi bi-arrow-counterclockwise"> Order Histoy</i></strong></p>
                                    </a>
                                    <!-- <small style="margin-left:23px">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</small> -->
                                </div>
                                <!-- Dropdown Items -->
                                <a class="dropdown-item" href="/cart"><i class="bi bi-cart3"></i> <strong>Cart</strong><br>
                                <small style="margin-left:23px"> {{ $totalProducts }} Items</small></a>
                                <!-- <a class="dropdown-item" href="#">Item 2</a> -->
                                <div class="balance dropdown-item">
                                    <a href="/topup/{{ Auth::user()->id }}" style="text-decoration: none" data-toggle="modal" data-target="#topUpModal{{Auth::user()->id}}">
                                        <p style="margin-bottom:0"><strong><i class="bi bi-plus-circle"> Top Up</i></strong></p>
                                    </a>
                                    <!-- <small style="margin-left:23px">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</small> -->
                                </div>
                                <div>
                                    <a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> <strong>Setting</strong><br>
                                </div>

                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:red"><i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}</a>
                                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

      <!-- Modal -->
<div class="modal fade" id="topUpModal{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="topUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 100%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topUpModalLabel">Top Up Saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Pilih nominal: </h5>
                <form method="POST" action="/topup-process/{{ Auth::user()->id }}">
                    @csrf

                    <div class="btn-group-toggle" data-toggle="buttons" style="margin: auto">
                        <div class="row" style="text-align: center; margin-bottom: 3%">
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="8000"> IDR 8.000
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="12000"> IDR 12.000
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="45000"> IDR 45.000
                                </label>
                            </div>
                        </div>

                        <div class="row" style="text-align: center; margin-bottom: 3%">
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="60000"> IDR 60.000
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="90000"> IDR 90.000
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="120000"> IDR 120.000
                                </label>
                            </div>
                        </div>

                        <div class="row" style="text-align: center; margin-bottom: 3%">
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="250000"> IDR 250.000
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="400000"> IDR 400.000
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="btn btn-outline-primary btn-block" style="display: inline-block; width: 100%;">
                                    <input type="radio" name="balance" value="600000" onclick="disableInputText()"> IDR 600.000
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- <h6><small>atau masukkan nominal disini: </small></h6>
                    <div class="col-md-12">
                         <label class="col-md-12" style="display: inline-block; width: 100%;">
                            <input type="text" name="balance" id="inputText" value="" class="col-md-12" style="border-radius: 1%" oninput="disableRadioButtons()"> 
                        </label>
                    </div> -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Top Up</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<body style="background-color: #202123">
@section('content')
<div class="container">
    <a class="btn btn-primary mb-2" href="/list">Kembali</a>
    <div class="card">
        <div class="card-body">
            <h4 class="my-auto">Master Produk</h4>
            <hr>
            <form action="/product/{{$products->id}}/update" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Nama*</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ $products->name }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- <div class="form-group">
                    <label for="image">Gambar</label>
                    <div class="custom-file">
                        <input id="image" class="custom-file-input" type="file" accept="image/png, image/jpeg" name="image_url" value="{{ old('image_url') }}">
                        <label id="image-label" class="custom-file-label" for="image_url">Pilih gambar</label>
                    </div>
                    @error('image_url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <div class="mb-3">
                    <label for="image" class="form-label">Cover</label>
                    <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="image_url" value="{{ $products->image_url }}">
                </div>
                <!-- <div class="form-group">
                    <label for="description">Description*</label>
                    <input id="description" class="form-control" type="text" name="description" value="{{ old('description') }}">
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description*</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" value="{{ $products->description }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Harga*</label>
                    <input id="price" class="form-control" type="text" name="price" value="{{ $products->price }}">
                    @error('price')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- <div class="form-group">
                    <label for="stock">Stock*</label>
                    <input id="stock" class="form-control" type="text" name="stock" value="{{ $products->stock }}">
                    @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> -->
                <hr>
                <div class="d-flex">
                    <button class="btn btn-primary ml-auto" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<!-- @section('scripts')
<script>
    document.getElementById('image').addEventListener('change', (e) => {
        const fullPath = document.getElementById('image').value

        if (fullPath) {
            const startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'))
            let filename = fullPath.substring(startIndex)

            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1)
            }

            document.getElementById('image-label').innerHTML = filename
        }
    })
</script>
@endsection -->