@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Invest in a Property</h1>

        @include('user_dash.components.finance')
        
        <div class="row g-1">
        {{$plans->links('pagination::bootstrap-5')}}
            @foreach($plans as $plan)
                <div class="col-lg-4 col-md-6 wow p-2 fadeInUp app-card" data-wow-delay="0.1s">
                    <div class="property-item rounded overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <a href=""><img class="img-fluid" src="{{$plan->image}}" alt=""></a>
                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Investable</div>
                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                        </div>
                        <div class="p-4 pb-0">
                            <a class="d-block h5 mb-2" href="">Available plans:</a>
                            <p>Basic Plan: <strong>${{number_format($type->basic_min,2)}} - ${{number_format($type->basic_max,2)}}</strong> for {{$type->basic_percent}}%</p>
                            @if($type->elite_min != 0)
                                <p>Elite Plan: <strong>${{number_format($type->elite_min,2)}} - ${{number_format($type->elite_max,2)}}</strong> for {{$type->elite_percent}}%</p>
                            @endif
                            @if($type->pro_min != 0)
                                <p>Pro Plan: <strong>{{number_format($type->pro_min,2)}} - infinity</strong> for  {{$type->pro_percent}}%</p>
                            @endif
                            
                        </div>

                        <div class="p-4 pb-0">
                            <a class="d-block h5 mb-2" href="">Duration:</a>
                            @if ($type->plan_type == 1)
                                <p>30 Days</p>
                            @elseif($type->plan_type == 2)
                                <p>6 Months</p>

                            @elseif($type->plan_type == 3)
                                <p>12 Months</p>
                            @endif
                        </div> 

                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$plan->size}} Sqft</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$plan->rooms}} Bed</small>
                        </div>

                        <div class="p-4 pb-0">
                            <a class="d-block text-white btn btn-primary mb-2" href="/dashboard/invests/create?plan_id={{$plan->plan_id}}&plan_type={{$type->plan_type}}">Invest</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <!--//col-->

        {{$plans->links('pagination::bootstrap-5')}}
        </div>
    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')