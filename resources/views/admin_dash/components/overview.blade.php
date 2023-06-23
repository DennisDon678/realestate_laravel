<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Overview</h1>

        @include('user_dash.components.finance')
        <!--//row-->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Investment History</h4>
                        </div>
                    </div>
                    <!--//row-->
                </div>

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
            <!--//app-card-->
        </div>
            <!--//col-->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h4 class="app-card-title">Deposit History</h4>
                            </div>
                        </div>
                        <!--//row-->
                    </div>

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
                                                    <th class="cell">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if(count($historys) > 0)
                                                @foreach($historys as $history)
                                                <tr>
                                                    <td class="cell">{{$history->transaction_id}}</td>
                                                    <td class="cell"><span class="truncate">{{$history->usd_amount}}</span></td>
                                                    <td class="cell">{{$history->created_at}}</td>
                                                    @if ($history->status === 'success')
                                                    <td class="cell"><span class="badge bg-success">{{$history->status}}</span></td>
                                                    @endif
                                                    @if ($history->status === 'pending')
                                                    <td class="cell"><span class="badge bg-warning">{{$history->status}}</span></td>
                                                    @endif
                                                    @if ($history->status === 'failed')
                                                    <td class="cell"><span class="badge bg-danger">{{$history->status}}</span></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan='5'>
                                                        <p class='text-center text-danger'>No Deposit has been made!</p>
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
                <!--//app-card-->
            </div>
        </div>
    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->