<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('gambar/Logo-GameVerse.png') }}">
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

    .button {
        float: left;
        margin: 0 5px 0 0;
        width: 100px;
        height: 40px;
        position: relative;
        background-color: white;
    }

    .button label,
    .button input {
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .button input[type="radio"] {
        opacity: 0.011;
        z-index: 100;
    }

    .button input[type="radio"]:checked + label {
        background: #20b8be;
        border-radius: 4px;
    }

    .button label {
        cursor: pointer;
        z-index: 90;
        line-height: 1.8em;
    }
</style>
<body>
    @include('layouts.navbar')
    <div class="container">
        <h1 style="color: white">Top Up Saldo</h1>
        <form method="POST" action="/topup-proccess/{{ $users->id }}">
            @csrf
            
            <div class="button">
                <input type="radio" id="a25" name="balance" />
                <label class="btn btn-default" for="a25" value="8000">IDR 8.000</label>
            </div>
            <div class="button">
                <input type="radio" id="a25" name="balance" />
                <label class="btn btn-default" for="a25" value="12000">IDR 12.000</label>
            </div>
            <div class="button">
                <input type="radio" id="a25" name="balance" />
                <label class="btn btn-default" for="a25" value="45000">IDR 45.000</label>
            </div>
            <div class="button">
                <input type="radio" id="a25" name="balance" />
                <label class="btn btn-default" for="a25" value="60000">IDR 60.000</label>
            </div>
            <div class="button">
                <input type="radio" id="a25" name="balance" />
                <label class="btn btn-default" for="a25" value="90000">IDR 90.000</label>
            </div>
            <div class="button">
                <input type="radio" id="a25" name="balance" />
                <label class="btn btn-default" for="a25" value="120000">IDR 120.000</label>
            </div>
            <div class="button">
                <input type="radio" id="a25" name="balance" value="250000"/>
                <label class="btn btn-default" for="a25">IDR 250.000</label>
            </div>

            <!-- <button type="submit" class="btn btn-primary">Top Up</button> -->
            <button type="submit">Topup</button>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function selectAmount(amount) {
        // Set the selected amount in the hidden input field
        document.getElementById('balance').value = amount;
        
        // Enable the "Top Up" button
        document.getElementById('topupButton').disabled = false;
    }
</script>

</body>
</html>
