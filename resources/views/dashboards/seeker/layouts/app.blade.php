<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta 
        name="csrf-token" 
        content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    
</head>
<body>
    @include('dashboards.seeker.styles.style')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a 
                    class="navbar-brand" 
                    href="{{ route('seeker.dashboard') }}">
                    <img 
                        src="{{ asset('/storage/images/sweethomeLogo.jpg') }}" 
                        alt="" 
                        class="logo"
                        width="32px;">
                        {{ config('app.name', 'Laravel') }}
                </a>
                <button 
                    class="navbar-toggler" 
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" 
                    aria-expanded="false" 
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div 
                    class="collapse navbar-collapse" 
                    id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a 
                                        class="nav-link" 
                                        href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a 
                                        class="nav-link " 
                                        href="{{ route('register') }}">{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item mr-4">
                                <a 
                                class="nav-link {{ (request()->is('seeker/dashboard')) ? 'active' : '' }}" 
                                href="{{ route('seeker.dashboard') }}">
                                <i class="fas fa-home"></i>
                                Home
                                </a>
                            </li>
                            <li class="nav-item mr-4">
                                <a 
                                class="nav-link {{ (request()->is('seeker/all-properties')) ? 'active' : '' }}" 
                                href="{{ route('seeker.all-properties') }}">
                                <i class="fas fa-list"></i>
                                Listings
                                </a>
                            </li>
                            <li class="nav-item mr-4">
                                <a 
                                class="nav-link {{ (request()->is('seeker/all-agents')) ? 'active' : '' }}" 
                                href="{{ route('seeker.all-agents') }}">
                                <i class="fas fa-user-tie"></i>
                                Agents
                                </a>
                            </li>
                            <li class="nav-item mr-4">
                                <a 
                                class="nav-link {{ (request()->is('seeker/about-us')) ? 'active' : '' }}" 
                                href="{{ route('seeker.about-us') }}">
                                <i class="fas fa-info-circle"></i>
                                About Us
                                </a>
                            </li>
                            <li class="nav-item mr-4">
                                <a href="{{ route('messages') }}" class="nav-link">
                                    <i class="fas fa-comments"></i>
                                    @if ($msg->count() != 0)
						                <span class="badge badge-danger">{{ $msg->count() }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a 
                                    id="navbarDropdown" 
                                    class="nav-link dropdown-toggle" 
                                    href="#" role="button" 
                                    data-toggle="dropdown" 
                                    aria-haspopup="true" 
                                    aria-expanded="false" 
                                    v-pre>
                                   
                                    {{ Auth::user()->given_name. ' ' . Auth::user()->last_name }}
                                </a>
                                
                                <div 
                                    class="dropdown-menu dropdown-menu-right" 
                                    aria-labelledby="navbarDropdown">
                                    <a href="{{ route('seeker.profile') }}" class="dropdown-item">
                                        <i class="fas fa-user"></i>
                                        {{ __('Profile') }}
                                    </a>
                                    <a href="{{ route('seeker.appointments') }}" class="dropdown-item">
                                        <i class="fas fa-calendar-check"></i>
                                        {{ __('Appointments') }}
                                    </a>
                                    {{-- <a href="{{ route('messages') }}" class="dropdown-item">
                                        <i class="fas fa-comments"></i>
                                        {{ __('Chat') }}
                                    </a> --}}
                                    <a href="{{ route('seeker.my-favorites') }}" class="dropdown-item">
                                        <i class="fas fa-star"></i>
                                        {{ __('Favorites') }}
                                    </a>
                                    <a href="{{ route('seeker.change-password') }}" class="dropdown-item">
                                        <i class="fas fa-unlock-alt"></i>
                                        {{ __('Change Password') }}
                                    </a>
                                    <a 
                                        class="dropdown-item" 
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>
                                    <form 
                                        id="logout-form" 
                                        action="{{ route('logout') }}" 
                                        method="POST" 
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>

        
    </div>
    <div class="container-fluid text-secondary">
        <footer class="border-top p-4">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <strong>SweetHome &copy;<small> VCAL</small></strong> 

            </div>
            <!-- Default to the left -->
            All Right Reserved<small> 2021</small>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    @yield('javascripts')
</body>
</html>
