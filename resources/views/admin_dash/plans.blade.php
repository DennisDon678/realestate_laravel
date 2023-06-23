@include('admin_dash.components.head')
@include('admin_dash.components.nav')
@include('admin_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Investment Plans</h1>

        @include('admin_dash.components.info')

        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Simple Investment</h4>
                            </div>
                        </div>
                        <!--//row-->
                    </div>

                    <div class="auth-form-container app-card-body p-3 p-lg-4 text-left">
                        @if (Session::has('message1'))
                        <p class="alert alert-success">{{ Session::get('message1') }}</p>
                        @endif

                        @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <form class="auth-form resetpass-form" action="/admins/plans" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{$simple->plan_type}}">
                            <div class="email mb-3">
                                <p>Minimum amount for basic plan</p>
                                <input id="reg-email" name="min" type="number" value="{{$simple->basic_min}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Maximum amount for basic plan</p>
                                <input id="reg-email" name="max" type="number" value="{{$simple->basic_max}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Rate for basic plan</p>
                                <input id="reg-email" name="percent" type="number" value="{{$simple->basic_percent}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->

                            <div class="email mb-3">
                                <p>Minimum amount for elite plan</p>
                                <input id="reg-email" name="min1" type="number" value="{{$simple->elite_min}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Maximum amount for elite plan</p>
                                <input id="reg-email" name="max1" type="number" value="{{$simple->elite_max}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Rate for elite plan</p>
                                <input id="reg-email" name="percent1" type="number" value="{{$simple->elite_percent}}" class="form-control login-email" required="required">
                            </div>

                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Minimum amount for pro plan</p>
                                <input id="reg-email" name="min2" type="number" value="{{$simple->pro_min}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Rate for pro plan</p>
                                <input id="reg-email" name="percent2" type="number" value="{{$simple->pro_percent}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Short Term Investment</h4>
                            </div>
                        </div>
                        <!--//row-->
                    </div>

                    <div class="auth-form-container app-card-body p-3 p-lg-4 text-left">
                        @if (Session::has('message2'))
                        <p class="alert alert-success">{{ Session::get('message2') }}</p>
                        @endif

                        @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <form class="auth-form resetpass-form" action="/admins/plans" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{$short->plan_type}}">
                            <div class="email mb-3">
                                <p>Minimum amount for basic plan</p>
                                <input id="reg-email" name="min" type="number" value="{{$short->basic_min}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Maximum amount for basic plan</p>
                                <input id="reg-email" name="max" type="number" value="{{$short->basic_max}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Rate for basic plan</p>
                                <input id="reg-email" name="percent" type="number" value="{{$short->basic_percent}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Long Term Investment</h4>
                            </div>
                        </div>
                        <!--//row-->
                    </div>

                    <div class="auth-form-container app-card-body p-3 p-lg-4 text-left">
                        @if (Session::has('message3'))
                        <p class="alert alert-success">{{ Session::get('message3') }}</p>
                        @endif

                        @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <form class="auth-form resetpass-form" action="/admins/plans" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{$long->plan_type}}">
                            <div class="email mb-3">
                                <p>Minimum amount for basic plan</p>
                                <input id="reg-email" name="min" type="number" value="{{$long->basic_min}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Maximum amount for basic plan</p>
                                <input id="reg-email" name="max" type="number" value="{{$long->basic_max}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="email mb-3">
                                <p>Rate for basic plan</p>
                                <input id="reg-email" name="percent" type="number" value="{{$long->basic_percent}}" class="form-control login-email" required="required">
                            </div>
                            <!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--//app-card-->
            </div>
        </div>
    </div>
</div>
@include('admin_dash.components.footer')
@include('admin_dash.components.foot')