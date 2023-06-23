@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-3 justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Notifications</h1>
                    </div>
                </div>
            </div>
            @if(count($notifications))
                @foreach($notifications as $notification)
                    <div class="app-card app-card-notification shadow-sm mb-4">
                        <div class="app-card-header px-4 py-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-lg-auto text-center text-lg-start">
                                    <div class="app-icon-holder icon-holder-mono">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                                        </svg>
                                    </div>
                                    <!--//app-icon-holder-->
                                </div>
                                <!--//col-->
                                <div class="col-12 col-lg-auto text-center text-lg-start">
                                    <h4 class="notification-title mb-1">{{$notification->title}}</h4>

                                    <ul class="notification-meta list-inline mb-0">
                                        <li class="list-inline-item">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</li>
                                        <li class="list-inline-item">|</li>
                                        @if($notification->status == 0)
                                            <li class="list-inline-item">Unread</li>
                                        @else
                                            <li class="list-inline-item">Read</li>
                                        @endif
                                        
                                    </ul>

                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-4">
                            <div class="notification-content">{{$notification->description}}</div>
                        </div>
                        <!--//app-card-body-->
                        <div class="app-card-footer px-4 py-3">
                            <a class="action-link" href="/dashboard/notifications/{{$notification->id}}">Mark as Read<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg></a>
                        </div>
                        <!--//app-card-footer-->
                    </div>
                @endforeach
            @else
            <div class="app-card app-card-notification shadow-sm mb-4">
                <p class="text-center p-5 text-danger">You have no notification yet!</p>
            </div>
            @endif
            <!--//app-card-->
            {{$notifications->links('pagination::bootstrap-5')}}
        </div>
        <!--//container-fluid-->
    </div>
@include('user_dash.components.footer')
@include('user_dash.components.foot')