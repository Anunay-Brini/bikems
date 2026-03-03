<nav class="navbar" id="navbar">
    <div class="logo">BikeMS</div>

    <ul class="nav-links">
        @guest
            <li><a href="{{ route('login') }}">🔐 Login</a></li>
            <li><a href="{{ route('register') }}">📝 Register</a></li>
        @endguest

        @auth
            <li class="icon-btn">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button>🚪 <span>Logout</span></button>
                </form>
            </li>
        @endauth
    </ul>
</nav>
