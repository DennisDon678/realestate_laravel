@include('admin_dash.components.head')
@include('admin_dash.components.nav')
@include('admin_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Withdrawal Info</h1>

        @include('admin_dash.components.info')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-23">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Withdrawal Details</h4>
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

                    <form class="auth-form resetpass-form" action="/admins/withdraw/approve" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="transaction_id" value="{{ $_GET['transaction_id']}}">
                        <div class="email mb-3">
                            <p>Amount in USD</p>
                            <input id="reg-email" name="amount" type="text" class="form-control login-email" value='{{$withdrawal->amount}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Prefered coin</p>
                            <input id="reg-email" name="coin" type="email" class="form-control login-email" value='{{$withdrawal->method}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Wallet address</p>
                            <input id="reg-email" name="wallet" type="email" class="form-control login-email" value='{{$withdrawal->wallet}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Approve</button>
                        </div>
                    </form>

                    <form action="/admins/withdraw/reject" method="post">
                    @csrf
                    <input type="hidden" name="transaction_id" value="{{ $_GET['transaction_id']}}">
                    <div class="text-center mt-1">
                        <button type="submit" class="btn app-btn btn-danger" style="color:white;">Reject</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin_dash.components.footer')
@include('admin_dash.components.foot')