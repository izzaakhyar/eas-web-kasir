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
        border-color: white;
    }

    .card:hover {
        transform: translateY(-2px);
        transition-duration: 0.2s;
        box-shadow: rgba(43, 27, 77, 0.4) 4px 4px 4px 4px,
        rgba(43, 27, 77, 0.5) 4px 4px 4px 4px;
        border-color: #8e69f3;
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
    @include('layouts.navbar')
</div>

<div class="container-fluid">
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
        
        <div class="row justify-content-center" style="margin-top: 0px">
            <div class="col-auto">
                <!-- Tombol Previous -->
                @if ($products->currentPage() > 1)
                    <a href="{{ $products->previousPageUrl() }}" class="btn btn-secondary btn-outline-light">
                        <i class="bi bi-chevron-left"></i>
                        <span class="hover-text"><i>Previous</i></span>
                    </a>
                @endif
            </div>
            <div class="col-auto">
                <!-- Tombol Next -->
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="btn btn-secondary btn-outline-light">
                        <span class="hover-text"><i>Next</i></span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>

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
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                                </button>
                            </form>
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