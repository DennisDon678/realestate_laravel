@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Support Inbox</h1>

        @include('user_dash.components.finance')

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover table-responsive mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Ticket ID</th>
                                        <th class="cell">Title</th>
                                        <th class="cell">Type</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                        <th class="cell">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(count($tickets) > 0)
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td class="cell">{{$ticket->ticket_id}}</td>
                                        <td class="cell"><span class="truncate">{{$ticket->title}}</span></td>
                                        <td class="cell">{{$ticket->type}}</td>
                                        <td class="cell">{{$ticket->status}}</td>
                                        <td class="cell"><a href="/dashboard/support/ticket/inbox/{{$ticket->ticket_id}}" class="btn app-btn-primary">View</a></td>
                                        <td class="cell">{{$ticket->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan='5'>
                                            <p class='text-center text-danger'>No Message at the moment!</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>


            </div>
            <!--//tab-pane-->
        </div>

    </div>
</div>






@include('user_dash.components.footer')
@include('user_dash.components.foot')