@include('admin_dash.components.head')
@include('admin_dash.components.nav')
@include('admin_dash.components.sidebar')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit User</h1>

        @include('admin_dash.components.info')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-8 mx-auto">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Edit Finace Form</h4>
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

                    <form class="auth-form resetpass-form" action="/admins/edit" method="POST">
                        @csrf
                        <!--//form-group-->
                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">User Email</label>
                            <small>Selected User:</small>
                            <input id="reg-email" type="email" name="email" class="form-control login-email" value='{{$user->email}}' required="required" readonly>
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            
                            <small>Action:</small>
                            <select name="action" id="" class="form-select login-email">
                            <option value="">Select an action</option>
                            <option value="fund">Fund User</option>
                            <option value="debit">Debit User</option>
                            </select>
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <small>Amount:</small>
                            <input id="reg-email" type="number" name="amount" class="form-control login-email" required="required" >
                        </div>

                        <div class="email mb-3">
                            <small>reason:</small>
                            <textarea name="reason" id="" style="min-height: 70px !important;" class="form-control" Placeholder="Enter Your reason Here" required></textarea>
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






@include('admin_dash.components.footer')
@include('admin_dash.components.foot')