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
                            <h4 class="app-card-title">Fund with cash</h4>
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
                    <P>Contact the finance team on any platform to initiate cash funding:</P>
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
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-stats-table h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">History</h4>
                            </div>
                            <!--//col-->
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
                                    @foreach($historys as $history)
                                    <tr>
                                        <td><a href="#">{{$history->transaction_id}}</a></td>
                                        <td class="stat-cell">${{$history->usd_amount}}</td>
                                        <td class="stat-cell">{{$history->status}}</td>
                                    </tr>
                                    @endforeach
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