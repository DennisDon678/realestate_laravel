@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl mb-4">
        <h1 class="app-page-title">My Account</h1>
        <div class="row gy-4">
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                </div>
                                <!--//icon-holder-->

                            </div>
                            <!--//col-->
                            <div class="col-auto">
                                <h4 class="app-card-title">Profile</h4>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Name</strong></div>
                                    <div class="item-data">{{Auth::user()->name}}</div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Email</strong></div>
                                    <div class="item-data">{{Auth::user()->email}}</div>
                                </div>
                                <!--//col-->

                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Username</strong></div>
                                    <div class="item-data">
                                        {{Auth::user()->username}}
                                    </div>
                                </div>
                                <!--//col-->

                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="item-label"><strong>Time Joined</strong></div>
                                    <div class="item-data">
                                        Since {{Auth::user()->created_at}}
                                    </div>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                    </div>
                    <!--//app-card-body-->
                    <div class="app-card-footer p-4 mt-auto">
                        <a class="btn app-btn-secondary" href="/dashboard/account/edit/profile">Manage Profile</a>
                    </div>
                    <!--//app-card-footer-->

                </div>
                <!--//app-card-->
            </div>
            <!--//col-->

            <!--//col-->
            <div class="app-card col-12 col-lg-6">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Change Password</h4>
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

                    <form class="auth-form resetpass-form" action="/dashboard/account/password/edit" method="POST">
                        @csrf
                        <div class="email mb-3">
                            <small>Old Password</small>
                            <input id="reg-email" name="old" type="text" class="form-control login-email" placeholder="Enter Your Old Password" required="required">
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <small>New Password</small>
                            <input id="reg-email" name="new" type="text" placeholder="Enter Your New Password" class="form-control login-email" required="required">
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Change Password</button>
                        </div>
                        <!--//form-group-->
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')