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
<style>
    .row {
        width: 100%;
    }
    .main_container-fluid {
        position: relative;
        width: 60%;
    }
    .image {
       
        display: block;
        width: 100%;
        height: auto;
    }
    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.75);
        overflow: hidden;
        width: 100%;
        height: 0;
        translate: 1.5s ease;
    }

    .main_container-fluid:hover .overlay {
        height: 100%;
        transition: 1s;
    }

    .game-title {
        width: 100%;
        margin-top: 30%;
        color: white;
        font-size: 2vw;
        position: absolute;
        text-align: center;
        transform: rotate(-5deg)skewX(-5deg);
    }

    button {
        text-align: center;
        /* color: black; */
        font-size: 1.2vw;
        margin: 100% 0 0 1%;
        width: 70%;
        /* letter-spacing: 5px; */
        /* line-height: 1.5em; */

        font-family: Raleway-SemiBold;
        
        color: white;
        background-color: rgba(108, 88, 179, 0.75);
        
        border: 2px solid rgba(108, 89, 179, 0.75);
        border-radius: 40px;
        /* background: transparent; */
        transition: all 0.3s ease 0s;
    }
</style>
@include('layouts.navbar')

<body style="background-color: #202123">
<div class="d-flex justify-content-between">
    <h2 style="color: white; margin-top: 1%; margin-left: 1%">{{ Auth::user()->name }}'s games</h2>
</div>
<div class="row">
    @foreach ($games as $game)
<div class="col-md-3">
<div class="card-body d-flex">
    <div class="main_container-fluid mx-auto text-center">
        <img src="{{ asset('storage/products/' . $game->product->portrait_cover) }}"
            class="img-fluid" alt="Sample image">
        <div class="overlay">
            <h1 class="game-title">{{ $game->product->name }}</h1>
            <button><i class="bi bi-download"></i> Download</button>
        </div>
    </div>
</div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

        
        
        
            
                <!-- <div class="card h-100" style="border-radius: 5%; background-color: black;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center mb-3">
                            
                        </div>
                        <div class="mb-3">
                            
                            
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary btn-outline-light btn-block">Beli</a>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->
        
<!-- <table>
    <tr>
        <th>No.</th>
        <th>Game</th>
        <th>Installed</th>
    </tr>
    @foreach($games as $game)
    <?php $i = 1 ?>
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $game->product->name }}</td>
        <td>{{ $game->installed }}</td>
    </tr>
    <?php $i++ ?>
    @endforeach
</table> -->