@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Withdrawal</h1>

        @include('user_dash.components.finance')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-6">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Withdrawal Form</h4>
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

                    <form class="auth-form resetpass-form" action="/dashboard/withdraw" method="POST">
                    @csrf
                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Your name</label>
                            <input id="reg-email" name="reg-email" type="text" class="form-control login-email" value='{{$user->name}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Your Email</label>
                            <input id="reg-email" name="reg-email" type="email" class="form-control login-email" value='{{$user->email}}' required="required" readonly>
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Amount</label>
                            <input id="reg-email" name="amount" type="number" class="form-control login-email" placeholder="Amount to withdraw in USD" required="required">
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Method</label>
                            <select name="method" id="" class="form-control form-select ">
                                <option value="">Choose a Withdrawal Method</option>
                                <option value="usdt">USDT</option>
                                <option value="btc">BTC</option>
                                <option value="eth">ETH</option>
                                <option value="doge">DOGE</option>
                                <option value="trx">TRX</option>
                            </select>
                        </div>
                        <!--//form-group-->


                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Amount</label>
                            <input id="reg-email" name="wallet" type="text" class="form-control login-email" placeholder="wallet Address" required="required">
                        </div>
                        <!--//form-group-->

                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Withdraw</button>
                        </div>
                    </form>
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
                                @if(count($withdrawals)>0)
                                    @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td><a href="#">{{$withdrawal->transaction_id}}</a></td>
                                        <td class="stat-cell">${{$withdrawal->amount}}</td>
                                        <td class="stat-cell">{{$withdrawal->status}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan='5'>
                                            <p class='text-center text-danger'>No Withdrawal has been made!</p>
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