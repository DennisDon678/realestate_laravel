@include('home.components.head')
@include('home.components.nav')
<div class="d-flex flex-column align-content-end">
    <div class="app-auth-body mx-auto">
        <h2 class="auth-heading text-center mt-5 mb-5">Login to Portal</h2>
        <div class="container text-start">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
        @endif
            <form class="auth-form auth-signup-form" action="/login" method="POST">
                @csrf
                <div class="email mb-3">
                    <label class="sr-only" for="">Your Email</label>
                    <input id="" name="email" type="email" class="form-control " placeholder="Email" >
                </div>

                <div class="password mb-3">
                    <label class="sr-only" for="signup-password">Password</label>
                    <input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Password" >
                </div>

                <div class="extra mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="hidden" value="" id="RememberPassword">
                        <label class="form-check-label" for="RememberPassword">
                            You agree to Portal's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
                        </label>
                    </div>
                </div>
                <!--//extra-->
                <div class="auth-option mb-3">
                <a class="text-link" href="/reset_password">Forgot password?</a>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100  mx-auto">Sign In</button>
                </div>
            </form>

            <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="/register">here</a>.</div>
        </div>
        <!--//auth-form-container-->

    </div>
    <!--//auth-body-->
</div>
@include('home.components.footer')

@include('home.components.foot')