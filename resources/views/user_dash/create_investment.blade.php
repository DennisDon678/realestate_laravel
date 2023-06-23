@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Deposit</h1>

        @include('user_dash.components.finance')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-12">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Create Investment</h4>
                        </div>
                    </div>
                </div>

                <div class="auth-form-container app-card-body p-3 p-lg-4 text-left">
                @if (Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif

                @if (Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif


                    <form class="auth-form resetpass-form" action="/dashboard/invest/create" method="POST">
                        @csrf
                        <div class="email mb-3">
                            <p>Plan ID</p>
                            <input id="reg-email" name="plan_id" type="text" class="form-control login-email" value="{{$plan_id}}" required="required" readonly>
                        </div>
                        <!--//form-group-->
                        
                        <div class="email mb-3">
                            <p>Plan Type</p>
                            <select name="plan" id="" class="form-control form-select " required>
                                <option value="">Choose a plan</option>
                                @if($rate->elite_min != 0)
                                <option value="{{$rate->basic_percent}}">Basic Plan: ${{number_format($rate->basic_min,2)}} - ${{number_format($rate->basic_max,2)}} for {{$rate->basic_percent}}%</option>
                                <option value="{{$rate->elite_percent}}">Elite Plan: ${{number_format($rate->elite_min,2)}} - ${{number_format($rate->elite_max,2)}} for {{$rate->elite_percent}}%</option>
                                <option value="{{$rate->pro_percent}}">Pro Plan: ${{number_format($rate->pro_min,2)}} - infinity for {{$rate->pro_percent}}%</option>
                                @else
                                <option value="{{$rate->basic_percent}}">Basic Plan: ${{number_format($rate->basic_min,2)}} - ${{number_format($rate->basic_max,2)}} for {{$rate->basic_percent}}%</option>
                                @endif
                            </select>
                        </div>
                        <!--//form-group-->
                        <input type="hidden" name="plan_type" value={{$rate->plan_type}}>
                        <div class="email mb-3">
                            <p>Duration (in days)</p>
                            @if($rate->plan_type == 1)
                                <input id="reg-email" name="duration" type="text" class="form-control login-email" value="30" required="required" readonly>
                            @elseif($rate->plan_type == 2)
                                <input id="reg-email" name="duration" type="text" class="form-control login-email" value="180" required="required" readonly>
                            @elseif ($rate->plan_type == 3)
                                <input id="reg-email" name="duration" type="text" class="form-control login-email" value="180" required="required" readonly>
                            @endif
                            
                        </div>

                        <div class="email mb-3">
                            <p>Amount to Invest</p>
                            <input id="reg-email" name="amount" type="text" class="form-control login-email" placeholder="Amount to invest in USD" required="required">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Invest</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')