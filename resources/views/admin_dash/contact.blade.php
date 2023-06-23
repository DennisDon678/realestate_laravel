@include('admin_dash.components.head')
@include('admin_dash.components.nav')
@include('admin_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Contact Information</h1>

        @include('admin_dash.components.info')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-23">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Contact</h4>
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

                    <form class="auth-form resetpass-form" action="/admins/contact" method="POST">
                        @csrf

                        <div class="email mb-3">
                            <p>Whatsapp</p>
                            <input id="reg-email" name="whatsapp" type="tel" value="{{$contact->whatsapp}}" class="form-control login-email" required="required">
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Telegram</p>
                            <input id="reg-email" name="telegram" type="tel" value="{{$contact->telegram}}" class="form-control login-email" required="required">
                        </div>
                        <!--//form-group-->
                        <div class="email mb-3">
                            <p>Email</p>
                            <input id="reg-email" name="email" type="email" value="{{$contact->email}}" class="form-control login-email" required="required">
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin_dash.components.footer')
@include('admin_dash.components.foot')