@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Select plan</h1>

        @include('user_dash.components.finance')

        <div class="row g-1">
            @foreach($plans as $plan)
            <div class="col-lg-4 col-md-6 wow p-2 fadeInUp app-card" data-wow-delay="0.1s">
                <div class="property-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <a href=""><img class="img-fluid" src="{{ asset('img/property-'.$plan->id.'.jpg') }}" alt=""></a>
                        @if($plan->id == 1)
                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Simple Budget</div>
                        @elseif ($plan->id == 2)
                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3"><span class="nav-icon" style='padding:2px; color:orange;'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                                    </svg></span>Popular</div>
                        @elseif ($plan->id == 3)
                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">VIP Offers</div>
                        @endif
                    
                    </div>
                    <div class="p-4 pb-0">
                        <a class="d-block h5 mb-2" href="">Details:</a>
                        <p><strong>{{ $plan->plan_name }}</strong></p>
                        <p>Duration: {{$plan->duration}} Months</p>
                        <p>Rate: 
                        @if($plan->id == 1)
                            10 - 12 percent
                        @elseif($plan->id == 2)
                            30 percent
                        @elseif($plan->id == 3)
                            45 percent
                        @endif
                        </p>

                        <p>Min-amount:
                            @if($plan->id == 1)
                            1000 USD
                            @elseif($plan->id == 2)
                            30,000 USD
                            @elseif($plan->id == 3)
                            100,000 USD
                            @endif
                        </p>
                    </div>
                    <div class="p-4 pb-0">
                        <a class="d-block text-white btn btn-primary mb-2" href="/dashboard/invest/{{$plan->id}}">Select</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!--//col-->
        </div>

    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')