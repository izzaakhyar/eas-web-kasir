<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('gambar/Logo-GameVerse.png') }}">
    <title>Edit Produk</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
@include('layouts.navbar')
<style>
    h4, label {
        color: white;
    }
</style>

<body style="background-color: #202123">

<div class="container" style="margin-top: 5%">
    <a class="btn btn-primary mb-2" href="/list">Kembali</a>
    <div class="card" style="background-color: #202123; border-color: white">
        <div class="card-body">
            <h4 class="my-auto">Edit Produk</h4>
            <hr>
            <form action="/product/{{$products->id}}/update" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group mb-3">
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

                <div class="mb-3">
                    <label for="image" class="form-label">Portrait Cover</label>
                    <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="portrait_cover" value="{{ $products->portrait_cover }}">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>