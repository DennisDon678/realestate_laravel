@include('home.components.head')
@include('home.components.nav')
<div class="d-flex flex-column align-content-end">
    <div class="app-auth-body w-50 mx-auto">
        <h2 class="auth-heading text-center mt-5 mb-5">Reset Password</h2>
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
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message')}}
            </div>
            @endif
            <form class="auth-form auth-signup-form mb-5" action="/reset_password" method="POST">
                @csrf
                <div class="email mb-3">
                    <label class="sr-only" for="">Your Email</label>
                    <input id="" name="email" type="email" class="form-control " placeholder="Enter your Email Address">
                </div>
                </div>

                <div class="text-center w-50 mx-auto mb-3">
                    <button type="submit" class="btn btn-primary w-100  mx-auto">Reset Password</button>
                </div>
            </form>
        </div>
        <!--//auth-form-container-->

    </div>
    <!--//auth-body-->
</div>
@include('home.components.footer')

@include('home.components.foot')