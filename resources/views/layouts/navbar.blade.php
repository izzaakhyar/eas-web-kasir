<nav class="navbar navbar-expand-md shadow-sm fixed-top" style="background-color: #2b1b4d; z-index: 999">
        <div class="container">
            <a class="navbar-brand" href="/list" style="align-content: center;"><img src="{{ asset('gambar/Logo-GameVerse.png') }}"
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
                    
                        @if (Auth::user()->role == 'Admin')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #f2e6d8" v-pre>
                            <img src="{{ asset('storage/products/' . Auth::user()->avatar) }}" alt="Profil {{ Auth::user()->name }}" class="img-fluid" style="width: 28px; height: 28px; margin-right: 3%; border-radius: 50%"> 
                                {{ Auth::user()->name }}
                            </a>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width:300px">
                                
                                <div class="balance dropdown-item">
                                    @php
                                        $adminBalance = App\Models\Order::sum('total_price');
                                    @endphp
                                    <p style="margin-bottom:0"><strong><i class="bi bi-wallet2"> Balance</i></strong></p>
                                    <small style="margin-left:23px">Rp {{ number_format($adminBalance, 0, ',', '.') }}</small>
                                </div>
                                <div class="balance dropdown-item">
                                    <a href="/history" style="text-decoration: none">
                                        <p style="margin-bottom:0"><strong><i class="bi bi-arrow-counterclockwise"> Order Histoy</i></strong></p>
                                    </a>
                                    <!-- <small style="margin-left:23px">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</small> -->
                                </div>
                                
                        
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #f2e6d8" v-pre>
                            <img src="{{ asset('avatar/' . Auth::user()->avatar) }}" alt="Profil {{ Auth::user()->name }}" class="img-fluid" style="width: 28px; height: 28px; margin-right: 3%; border-radius: 50%"> 
                                {{ Auth::user()->name }}
                            </a>

                            <!-- background-color: #202123 -->
                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width:300px;">
                                <div class="balance dropdown-item">
                                    @php
                                        $gameCount = App\Models\Game::where('user_id', auth()->id())->count();
                                    @endphp
                                    <a href="/library" style="text-decoration: none; color: black">
                                    <p style="margin-bottom:0"><strong><i class="bi bi-controller"></i> Library</i></strong></p>
                                    <small style="margin-left:23px">{{ $gameCount }} Games Owned</small>
                                    </a>
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
                                    <a class="dropdown-item" href="/setting/{{ Auth::user()->id }}"><i class="bi bi-gear-fill"></i> <strong>Setting</strong><br>
                                </div>
                        @endif
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:red"><i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}</a>
                                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    
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
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Top Up</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
