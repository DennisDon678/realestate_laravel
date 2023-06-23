@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Rent a Property</h1>

        @include('user_dash.components.finance')
        <div class="row g-4">
            {{$listings->links('pagination::bootstrap-5')}}
                @foreach($listings as $listing )
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="property-item rounded overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <a href=""><img class="img-fluid" src="{{$listing->image1}}" alt="" width="500" height="600"></a>
                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                        </div>
                        <div class="p-4 pb-0">
                            <h5 class="text-primary mb-3">${{number_format($listing->price,2)}} /month</h5>
                            <a class="d-block h5 mb-2" href=""></a>
                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$listing->address}}</p>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$listing->size}} Sqft</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$listing->bedrooms}} Bed</small>
                        </div>

                        <div class="p-4 pb-0">
                            <a class="d-block text-white btn btn-primary mb-2" href="/dashboard/rent/{{$listing->property_id}}">Rent Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            <!--//col-->
        </div>
        {{$listings->links('pagination::bootstrap-5')}}
    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')