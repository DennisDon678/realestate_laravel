@include('home.components.head')
@include('home.components.nav')
        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">About Us</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">About</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="{{asset('img/header.jpg')}}" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->

        @include('home.components.search')
        @include('home.components.about')
        @include('home.components.call')
        @include('home.components.team')



  @include('home.components.footer')

  @include('home.components.foot')