@include('home.components.head')
@include('home.components.nav')

<div class="d-flex flex-column align-content-end">
    <div class="app-auth-body mx-auto">
        <h2 class="auth-heading text-center mt-5 mb-5">Sign up to Portal</h2>
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

       
            <form class="auth-form auth-signup-form" action='/register' method="POST">
            @csrf
                <div class="email mb-3">
                    <label class="sr-only" for="name">Your Name</label>
                    <input id="" name="name" type="text" class="form-control " placeholder="Full name" >
                </div>

                <div class="email mb-3">
                    <label class="sr-only" for="email">Your Email</label>
                    <input id="" name="email" type="email" class="form-control " placeholder="Email" >
                </div>

                <div class="email mb-3">
                    <label class="sr-only" for="username">Your username</label>
                    <input id="username" name="username" type="text" class="form-control " placeholder="Your username" autocomplete="username">
                </div>

                <div class="password mb-3">
                    <label class="sr-only" for="password">Password</label>
                    <input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Create a password" >
                </div>
                @if(isset($_GET['referral_id']))
                    <div class="password mb-3">
                        <label class="sr-only" for="referred_by">Referral ID</label>
                        <input id="referred_by" name="referred_by" type="text" value={{$_GET['referral_id']}} class="form-control signup-password" placeholder="Referral ID (optional)">
                    </div>
                @else
                <div class="password mb-3">
                    <label class="sr-only" for="referred_by">Referral ID</label>
                    <input id="referred_by" name="referred_by" type="text" class="form-control signup-password" placeholder="Referral ID (optional)">
                </div>
                @endif

                <div class="extra mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="check" id="RememberPassword" checked>
                        <label class="form-check-label" for="RememberPassword">
                            I agree to Portal's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
                        </label>
                    </div>
                </div>
                <!--//extra-->

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100  mx-auto">Sign Up</button>
                </div>
            </form>
            <!--//auth-form-->

            <div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="/login">Log in</a></div>
        </div>
        <!--//auth-form-container-->
    </div>
    <!--//auth-body-->
</div>
@include('home.components.footer')

@include('home.components.foot')