<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('gambar/Logo-GameVerse.png') }}">
    <title>GameVerse store</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/coba.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<style>
    .btn-next {
        background-color: #8e69f3;
    }
</style>

<body style="background-color: #202123">
<!-- <body style="background-color: #e5fbfc"> -->
<!-- <body style="background-image: url('gambar/wallpaper.jpg'); background-size: cover"> -->

@if (Auth::user()->role == 'Admin')
<div id="app">
    @include('layouts.navbar')
</div>

<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <div>
            <a class="btn btn-secondary mb-2 mr-auto" href="/create" style="margin-top:8px"><i class="bi bi-plus-square"></i><span class="hover-text"> <i>Tambah Produk</i></span></a>
        </div>
        <div>
            <a class="btn btn-secondary mb-2 ml-auto" href="/history" style="margin-top:8px"><i class="bi bi-receipt"></i><span class="hover-text"> <i>Riwayat Transaksi</i></span></a>
        </div>
    </div>

    @else
    <div id="app" style="margin-bottom: 2%">
        @include('layouts.navbar')
    </div>
    <div class="container-fluid">
    @endif

    <div class="row">
        @foreach($products as $product)
        <!-- #f8f8f6 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="/detail/{{$product->id}}" class="card-link" data-toggle="modal" data-target="#myModal{{$product->id}}">
                <div class="card h-100" style="border-radius: 5%; background-color: black;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center mb-3">
                            @if (strlen($product->image_url) > 0)
                                <img src="{{ asset('storage/products/' . $product->image_url) }}" alt="{{ $product->name }}" style="max-height: 200px; width: 500px; border: 1px solid white" class="img-fluid">
                            @else
                                <span class="text-muted">Gambar tidak tersedia</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h5 class="card-title" style="color: #f8f8f6">{{ $product->name }}</h5>
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
        
        @if (Auth::user()->role == 'Admin')
        <div class="row justify-content-center" style="margin-top: -10px">
            <div class="col-auto">
                <!-- Tombol Previous -->
                @if ($products->currentPage() > 1)
                    <a href="{{ $products->previousPageUrl() }}" class="btn btn-secondary btn-outline-light btn-sm">
                        <i class="bi bi-chevron-left"></i>
                        <span class="hover-text"><i>Previous</i></span>
                    </a>
                @endif
            </div>
            <div class="col-auto">
                <!-- Tombol Next -->
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="btn btn-next btn-outline-light btn-sm">
                        <span class="hover-text"><i>Next</i></span>
                        <i class="bi bi-chevron-right bi-xs"></i>
                    </a>
                @endif
            </div>
        </div>
        @else
        <div class="row justify-content-center" style="margin-top: 0px">
            <div class="col-auto">
                <!-- Tombol Previous -->
                @if ($products->currentPage() > 1)
                    <a href="{{ $products->previousPageUrl() }}" class="btn btn-secondary btn-outline-light btn-sm">
                        <i class="bi bi-chevron-left"></i>
                        <span class="hover-text"><i>Previous</i></span>
                    </a>
                @endif
            </div>
            <div class="col-auto">
                <!-- Tombol Next -->
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="btn btn-secondary btn-outline-light btn-sm">
                        <span class="hover-text"><i>Next</i></span>
                        <i class="bi bi-chevron-right bi-xs"></i>
                    </a>
                @endif
            </div>
        </div>
        @endif

        @if (Auth::user()->role == 'Admin')
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
                                    <img src="{{ asset('storage/products/' . $product->portrait_cover) }}" alt="{{ $product->name }}" class="img-fluid">                 
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{$product->name}}</strong></p>
                                    <p><strong>Deskripsi:</strong></p>
                                    <p>{{$product->description}}</p>
                                    <p><strong>Stok:</strong> </p>
                                    <p><strong>Harga:</strong> Rp {{ number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        
                                <a href="/product/{{$product->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm
                                    ('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                                
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @else
        @foreach ($products as $product)
            <div class="modal fade" id="myModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">{{$product->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/products/' . $product->portrait_cover) }}" alt="{{ $product->name }}" class="img-fluid">                 
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{$product->name}}</strong></p>
                                    <p><strong>Deskripsi:</strong></p>
                                    <p>{{$product->description}}</p>
                                    <p><strong>Stok:</strong> </p>
                                    <p><strong>Harga:</strong> Rp {{ number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        @php
                        $game = App\Models\Game::where('user_id', Auth::user()->id)
                            ->where('product_id', $product->id)
                            ->first();
                    @endphp
                    @if ($game)
                        <a href="/library" class="btn btn-primary">
                            <i class="bi bi-folder2-open"></i> Lihat Library
                        </a>
                            @else
                                
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function disableInputText() {
        document.getElementById('inputText').disabled = true;
    }

    function disableRadioButtons() {
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        for (let i = 0; i < radioButtons.length; i++) {
            radioButtons[i].disabled = true;
        }
    }
</script>

</body>