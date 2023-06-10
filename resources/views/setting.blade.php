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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
@include('layouts.navbar')

<body style="background-color: #202123">

<div class="container" style="margin-top: 5%">
    <a class="btn btn-primary mb-2" href="/list">Kembali</a>
    <form action="/user/{{$users->id}}/update" method="POST">
                {{csrf_field()}}
    <div class="card">
    <div class="card-body media align-items-center">
  <div class="d-grid gap-3">
    <div class="d-flex">
      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="d-block ui-w-80 img-fluid">
      <div class="form-group flex-grow-1" style="margin-left: 1%; margin-top: 5.5%">
        <label class="form-label">Username</label>
        <input type="text" class="form-control mb-1" value="nmaxwell">

        <label for="image" class="form-label">Avatar</label>
        <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="avatar" value="{{ $users->avatar }}">
        
                <div class="d-flex justify-content-end" style="margin-top: 2%">
                    <button class="btn btn-primary ml-auto" type="submit">Simpan</button>
                </div>
</form>
      </div>
    </div>
    

  </div>
</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

 <!-- <h4 class="my-auto">Master Produk</h4>
            <hr>
            <form action="/user/{{$users->id}}/update" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Nama*</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ $users->name }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Avatar</label>
                    <input class="form-control" type="file" id="formFile" accept="image/png, image/jpeg" name="avatar" value="{{ $users->avatar }}">
                </div>
                
                <hr>
                <div class="d-flex">
                    <button class="btn btn-primary ml-auto" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div> -->

    <!-- <div class="media-body ml-4">
                  <label class="btn btn-outline-primary">
                    Upload new photo
                    <input type="file" class="account-settings-fileinput">
                  </label> &nbsp;
                  <button type="button" class="btn btn-default md-btn-flat">Reset</button>

                  <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div> -->