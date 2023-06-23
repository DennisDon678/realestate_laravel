@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl mb-4">
        <h1 class="app-page-title">Buy a Property</h1>

        @include('user_dash.components.finance')
        <div class="row g-4 mt-4">
            <div class="col-lg-8 col-md-6 wow fadeInUp bg-white p-3 mx-auto"  data-wow-delay="0.1s">
                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }} <a href="/dashboard/deposit">click here</a> to fund your wallet.</p>
                @endif
                <div class="property-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <a href=""><img class="img-fluid" src="{{$listing->image1}}" alt=""></a>
                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Paid</div>
                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                    </div>
                    <div class="p-4 pb-0">
                        <h5 class="text-primary mb-3">${{number_format($listing->price,2)}}</h5>
                        <a class="d-block h5 mb-2" href=""></a>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$listing->address}}</p>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$listing->size}} Sqft</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$listing->bedrooms}} Bed</small>
                    </div>

                    <div class="p-4 pb-0">
                    <p>Contact Agent:</p>
                        <div class="text-center row">
                            <div class="col-4">
                                <a href="/dashboard/deposit/crypto" class=''><img src="https://www.logo.wine/a/logo/WhatsApp/WhatsApp-Logo.wine.svg" alt="" width='100'></a>
                            </div>
                            <div class="col-4">
                                <a href="/dashboard/deposit/cash" class=''><img src="https://www.logo.wine/a/logo/Telegram_(software)/Telegram_(software)-Logo.wine.svg" alt="" width='100'></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')