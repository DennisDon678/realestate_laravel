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
                            <h4 class="app-card-title">Crypto Deposit Form</h4>
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


                    @if(isset($deposit))
                    <p class="alert alert-warning">Ensure you are sending the right coin to the right address.</p>
                    <form class="auth-form resetpass-form" action="/dashboard/deposit" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="usd" value="{{$_GET['amount']}}">
                        <div class="email mb-3">
                            <p>Amount</p>
                            <input id="reg-email" name="amount" type="text" class="form-control login-email" value='{{$deposit['amount']}} {{$deposit['coin']}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Prefered coin</p>
                            <input id="reg-email" name="coin" type="email" class="form-control login-email" value='{{$deposit['coin']}}' required="required" readonly>
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <p>Wallet address</p>
                            <input id="reg-email" name="wallet" type="email" class="form-control login-email" value='{{$deposit['address']}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Screenshot</p>
                            <input id="reg-email" name="image" type="file" class="form-control " value='{{$deposit['address']}}' required="required">
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Deposit</button>
                        </div>
                    </form>
                    @else
                    <form class="auth-form resetpass-form" action="/dashboard/deposit" method="GET">
                        @csrf
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

                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Amount</label>
                            <input id="reg-email" name="amount" type="number" class="form-control login-email" placeholder="Amount to Deposit in USD -- Min. USD 100 " required="required">
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Method</label>
                            <select name="coin" id="" class="form-control form-select " required>
                                <option value="">Choose a Deposit Method</option>
                                @foreach($deposit_options as $option)
                                <option value="{{$option->coin}}" style="text-transform: uppercase;">{{$option->coin}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Deposit</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-stats-table h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">History</h4>
                            </div>
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