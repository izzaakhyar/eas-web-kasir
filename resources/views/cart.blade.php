<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('gambar/Logo-GameVerse.png') }}">
    <title>{{ Auth::user()->name }}'s Cart</title>

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
<body style="background-color: #202123;">
<div id="app">
@include('layouts.navbar')
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