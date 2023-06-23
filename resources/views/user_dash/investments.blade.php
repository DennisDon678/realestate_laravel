@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Investment History</h1>

        @include('user_dash.components.finance')

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover table-responsive mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Amount</th>
                                        <th class="cell">Created at</th>
                                        <th class="cell">End at</th>
                                        <th class="cell">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @if(count($investments) > 0)
                                    @foreach($investments as $investment)
                                    <tr>
                                        <td class="cell">{{$investment->plan_id}}</td>
                                        <td class="cell"><span class="truncate">{{$investment->amount}}</span></td>
                                        <td class="cell">{{$investment->created_at}}</td>
                                        <td class="cell">{{$investment->end_date}}</td>
                                        @if ($investment->status === 'active')
                                        <td class="cell"><span class="badge bg-success">{{$investment->status}}</span></td>
                                        @endif
                                        @if ($investment->status === 'completed')
                                        <td class="cell"><span class="badge bg-danger">{{$investment->status}}</span></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                    <td colspan='5'>
                                    <p class='text-center text-danger'>No investment has been made!</p>
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