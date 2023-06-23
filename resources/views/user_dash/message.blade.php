@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="position-relative mb-3">
            <div class="row g-3 justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Messages</h1>
                </div>
            </div>
        </div>
        @if(count($messages)>0)
        @foreach($messages as $message)
        <div class="app-card app-card-notification shadow-sm mb-4">
            <div class="app-card-header px-4 py-3">
                <div class="row g-3 align-items-center">
                    <div class="col-12 col-lg-auto text-center text-lg-start">
                        <div class="app-icon-holder icon-holder-mono">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-inbox" viewBox="0 0 16 16">
                                <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
                            </svg>
                        </div>
                        <!--//app-icon-holder-->
                    </div>
                    <!--//col-->
                    <div class="col-12 col-lg-auto text-center text-lg-start">
                        <h4 class="notification-title mb-1">{{$ticket->title}}</h4>

                        <ul class="notification-meta list-inline mb-0">
                            <li class="list-inline-item">{{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</li>
                            <li class="list-inline-item">|</li>
                            <li class="list-inline-item">{{$message->type}}</li>

                        </ul>

                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-4">
            <p>Message:</p>
                <div class="notification-content">{{$message->message}}</div>
            </div>
            <!--//app-card-body-->
            <div class="app-card-footer px-4 py-3">
                <a class="action-link" href="/dashboard/support/ticket/inbox/{{$ticket->ticket_id}}/reply">Reply<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                    </svg></a>
            </div>
            <!--//app-card-footer-->
        </div>
        @endforeach
        @else
        <div class="app-card app-card-notification shadow-sm mb-4">
            <p class="text-center p-5 text-danger">You have no message yet!</p>
        </div>
        @endif
        <!--//app-card-->
    </div>
    <!--//container-fluid-->
</div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')