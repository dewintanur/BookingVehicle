<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Booking App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Vehicle Booking App</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vehicles.index') }}">Vehicles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookings.index') }}">Bookings</a>
                        </li>
                    @elseif(Auth::check() && Auth::user()->role === 'approver')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookings.show') }}">Bookings</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
