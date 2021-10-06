<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">Brand</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                    <li class="nav-item">
                    <form action="/logout" method="post" id="logout">
                    @csrf
                        <a class="nav-link" href="#" onclick="document.getElementById('logout').submit()">
                        <i class="fas fa-sign-out-alt"></i>
                        Sign Out
                        </a>
                    </form>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="/login">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>