@include('admin_dash.components.head')
@include('admin_dash.components.nav')
@include('admin_dash.components.sidebar')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Support Inbox</h1>

        @include('admin_dash.components.info')

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover table-responsive mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Ticket ID</th>
                                        <th class="cell">Type</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(count($tickets) > 0)
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td class="cell">{{$ticket->ticket_id}}</td>
                                        <td class="cell">{{$ticket->type}}</td>
                                        <td class="cell">{{$ticket->status}}</td>
                                        <td class="cell"><a href="/admins/inbox/{{$ticket->ticket_id}}" class="btn app-btn-primary">View</a></td>
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






@include('admin_dash.components.footer')
@include('admin_dash.components.foot')