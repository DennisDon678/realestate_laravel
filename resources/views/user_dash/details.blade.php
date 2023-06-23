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
                            <h4 class="app-card-title">Deposit Details</h4>
                        </div>
                    </div>
                </div>

                <div class="auth-form-container app-card-body p-3 p-lg-4 text-left">

                    <form class="auth-form resetpass-form">
                        <div class="email mb-3">
                            <p>Transaction ID</p>
                            <label class="sr-only" for="reg-email"></label>
                            <input id="reg-email" name="amount" type="text" class="form-control login-email" value="{{$deposit->transaction_id}}" readonly>
                        </div>
                       
                        <div class="email mb-3">
                            <p>USD amount</p>
                            <label class="sr-only" for="reg-email"></label>
                            <input id="reg-email" name="reg-email" type="text" class="form-control login-email" value="USD {{ $deposit->usd_amount}}" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Amount to Send</p>
                            <label class="sr-only" for="reg-email"></label>
                            <input id="reg-email" name="reg-email" type="email" class="form-control login-email" value="{{$deposit->coin_amount}} {{$deposit->coin}}" required="required" readonly>
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <p>Wallet Address</p>
                            <label class="sr-only" for="reg-email"></label>
                            <input id="reg-email" name="amount" type="text" class="form-control login-email" value="{{$deposit->wallet_address}}" readonly>
                        </div>
                        <!--//form-group-->
                         <div class="email mb-3">
                            <p>Status</p>
                             <label class="sr-only" for="reg-email"></label>
                             <input id="reg-email" name="amount" type="text" class="form-control login-email" value="{{$deposit->status}}" readonly>
                         </div>

                          <div class="email mb-3">
                              <p>Expiration Time</p>
                              <label class="sr-only" for="reg-email"></label>
                              <input id="reg-email" name="amount" type="text" class="form-control login-email" value="{{$deposit->expiration}}" readonly>
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
                                        <th class="meta">Source</th>
                                        <th class="meta stat-cell">Views</th>
                                        <th class="meta stat-cell">Today</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="#">google.com</a></td>
                                        <td class="stat-cell">110</td>
                                        <td class="stat-cell">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                            </svg>
                                            30%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">getbootstrap.com</a></td>
                                        <td class="stat-cell">67</td>
                                        <td class="stat-cell">23%</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">w3schools.com</a></td>
                                        <td class="stat-cell">56</td>
                                        <td class="stat-cell">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                            </svg>
                                            20%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">javascript.com </a></td>
                                        <td class="stat-cell">24</td>
                                        <td class="stat-cell">-</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">github.com </a></td>
                                        <td class="stat-cell">17</td>
                                        <td class="stat-cell">15%</td>
                                    </tr>
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