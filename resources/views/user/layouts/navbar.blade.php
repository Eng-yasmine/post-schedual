<nav class="navbar navbar-expand-lg navbar-light bg-dark" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('welcome') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('posts.create') }}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('posts.create') }}">PlatForms</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else

                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
