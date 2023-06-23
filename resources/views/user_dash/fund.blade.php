@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Deposit</h1>

        @include('user_dash.components.finance')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-6">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Select Funding Method</h4>
                        </div>
                    </div>
                </div>

                <div class="auth-form-container app-card-body p-3 p-lg-4 text-left">

                    <div class="email mb-3">
                        <label class="sr-only" for="reg-email">Your name</label>
                        <input id="reg-email" type="text" class="form-control login-email" value='{{$user->name}}' required="required" readonly>
                    </div>
                    <!--//form-group-->
                    <div class="email mb-3">
                        <label class="sr-only" for="reg-email">Your Email</label>
                        <input id="reg-email" type="email" class="form-control login-email" value='{{$user->email}}' required="required" readonly>
                    </div>
                    <!--//form-group-->

                    <!--//form-group-->
                    <div class="text-center row gx-5">
                        <div class="col">
                        <a href="/dashboard/deposit/crypto" class='btn app-btn-primary theme-btn'>Fund With Crypto</a>
                        </div>
                        <div class="col">
                            <a href="/dashboard/deposit/cash" class='btn app-btn-primary theme-btn'>Fund With Cash</a>
                        </div>
                    </div>
                </div>
                
                <p>We accept:</p>
                <div class="images row">
                    <div class="col">
                        <img src="https://www.logo.wine/a/logo/Cash_App/Cash_App-Full-Logo.wine.svg" alt="" width='150'>
                    </div>

                    <div class="col">
                        <img src="https://www.logo.wine/a/logo/Western_Union/Western_Union-Logo.wine.svg" alt="" width='150'>
                    </div>
                    <div class="col">
                        <img src="https://www.logo.wine/a/logo/Bitcoin/Bitcoin-Logo.wine.svg" alt="" width='150'>
                    </div>
                    <div class="col">
                        <img src="https://www.logo.wine/a/logo/Ethereum/Ethereum-Landscape-Black-Logo.wine.svg" alt="" width='150'>
                    </div>
                    <div class="col">
                        <img src="https://www.logo.wine/a/logo/Apple_Pay/Apple_Pay-Logo.wine.svg" alt="" width='150'>
                    </div>

                    <div class="col">
                        <img src="https://www.logo.wine/a/logo/Tether_(cryptocurrency)/Tether_(cryptocurrency)-Logo.wine.svg" alt="" width='150'>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-stats-table h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">History</h4>
                            </div>
                            <!--//col-->
                            <div class="col-auto">
                                <div class="card-header-action">
                                    <a href="#">View report</a>
                                </div>
                                <!--//card-header-actions-->
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body p-3 p-lg-4">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead>

                                    <tr>
                                        <th class="meta">ID</th>
                                        <th class="meta stat-cell">Amount</th>
                                        <th class="meta stat-cell">Status</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @if(count($historys) > 0)
                                    @foreach($historys as $history)
                                    <tr>
                                        <tr>
                                            <td><a href="#">{{$history->transaction_id}}</a></td>
                                            <td class="stat-cell">${{$history->usd_amount}}</td>
                                            <td class="stat-cell">{{$history->status}}</td>
                                        </tr>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan='5'>
                                            <p class='text-center text-danger'>No Deposit has been made!</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
        </div>
    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')