@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Support Ticket</h1>

        @include('user_dash.components.finance')

        <div class="row p-4 g-4 mb-4">
            <div class="app-card col-12 col-lg-8 mx-auto">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Reply Form</h4>
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

                    <form class="auth-form resetpass-form" action="/dashboard/tickets/reply" method="POST">
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
                            <label class="sr-only" for="reg-email">Ticket ID</label>
                            <input id="reg-email" name="ticket_id" type="text" class="form-control login-email" Value="{{$ticket->ticket_id}}" required="required" readonly>
                        </div>
                        <!--//form-group-->

                        <div class="email mb-3">
                            <label class="sr-only" for="reg-email">Message</label>
                            <textarea name="message" id="" style="min-height: 70px !important;" class="form-control" Placeholder="Enter Your Message Here" required></textarea>
                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






@include('user_dash.components.footer')
@include('user_dash.components.foot')