@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl mb-4">
        <h1 class="app-page-title">Rent a Property</h1>

        @include('user_dash.components.finance')
        <div class="row g-4 mt-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }} <a href="/dashboard/deposit">click here</a> to fund your wallet.</p>
                @endif
                <div class="p-4 pb-0">
                    <h3>Price:</h3>
                    <h5 class="text-primary mb-3">${{number_format($listing->price,2)}}</h5>
                    <a class="d-block h5 mb-2" href=""></a>
                    <h3>Address:</h3>
                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$listing->address}}</p>
                </div>
                <div class="d-flex border-top">
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$listing->size}} Sqft</small>
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$listing->bedrooms}} Bed</small>
                </div>
                <div class="p-4 pb-0">
                    <a class="d-block text-white btn btn-primary mb-2" href="/dashboard/rent/contact/{{$listing->property_id}}">Contact Agent</a>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            <h4>More photos:</h4>
            @foreach($images as $image )
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="property-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <a href=""><img class="img-fluid" src="{{$image}}" alt="" width="500" height="600"></a>
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