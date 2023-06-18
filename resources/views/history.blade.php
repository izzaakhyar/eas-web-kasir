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
    <link rel="stylesheet" href="{{ URL::asset('css/coba.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<!-- <style>
        h3, p, th, td, hr, .me-3 {
            color: white;
        }
    </style> -->
@include('layouts.navbar')
<body style="background-color: #202123">


<div class="container-fluid">
  <div class="container">
    <!-- Title -->
    <div class="d-flex justify-content-between align-items-center py-3">
      <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> </h2>
    </div>

    <!-- Main content -->
    <div class="row">
      <div class="col-lg-12">
        <!-- Details -->

        @foreach ($orderHistory as $orderId => $items)
  <div class="card mb-4" style="background-color: #202123; border-color: white">
    <div class="card-body">
      <div class="mb-3 d-flex justify-content-between">
        <div>
          <span class="me-3" style="color: white">{{ $items->first()->order->date }}</span>
          <span class="me-3" style="color: white">#{{ $orderId }}</span>
          @if ($items->first()->order && $items->first()->order->user)
  <span class="badge rounded-pill bg-info">{{ $items->first()->order->user->name }}</span>
@endif
        </div>
        <div class="d-flex">
          <button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text">
            <i class="bi bi-download"></i>
            <span class="text">Invoice</span>
          </button>
          <div class="dropdown">
            <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
            </ul>
          </div>
        </div>
      </div>

      <table class="table">
        <tbody>
          @php
          $subTotal = 0; // Variabel untuk menyimpan subtotal
          @endphp
          @foreach ($items as $item)
          <tr>
            <td>
              <div class="d-flex mb-2">
                <div class="flex-shrink-0">
                  <img src="{{ asset('storage/products/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="max-width: 100px;">
                </div>
                <div class="flex-lg-grow-1 ms-3">
                  <h6 class="small mb-0" style="color: white"><a href="#" class="text-reset" style="text-decoration: none">{{ $item->product->name }}</a></h6>
                </div>
              </div>
            </td>
            <td>1</td>
            <td class="text-end" style="color: white">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
          </tr>
          @php
          $subTotal += $item->product->price; // Menambahkan harga produk ke subtotal
          @endphp
          @endforeach
        </tbody>
        <tfoot>
          <tr class="fw-bold">
            <td colspan="2" style="color: white">TOTAL</td>
            <td class="text-end" style="color: white">Rp {{ number_format($subTotal, 0, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endforeach


      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
