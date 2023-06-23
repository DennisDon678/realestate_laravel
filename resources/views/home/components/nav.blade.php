        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="/" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="{{asset('img/icon-deal.png')}}" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">{{$site->site_name}}</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="/" class="nav-item nav-link {{ (request()->is('/')) ? 'active' : '' }}">Home</a>
                        <a href="/about" class="nav-item nav-link {{ (request()->is('about')) ? 'active' : '' }}">About</a>
                        <a href="/login" class="nav-item nav-link {{ (request()->is('login')) ? 'active' : '' }}">Login</a>
                    </div>
                    <a href="/register" class="btn btn-primary px-3 mb-3 mb-lg-0">Get started</a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->