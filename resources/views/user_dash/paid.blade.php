@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Buying History</h1>
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
                                        <th class="cell">Paid Amount</th>
                                        <th class="cell">Full Amount</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @if(count($paid)>0)
                                    @foreach($paid as $paid)
                                    <tr>
                                        <td class="cell">{{$paid->property_id}}</td>
                                        <td class="cell"><span class="truncate">{{$paid->paid_amount}}</span></td>
                                        <td class="cell">{{$paid->full_amount}}</td>
                                        <td class="cell"><a href="/dashboard/paid/{{$paid->property_id}}" class='btn app-btn-primary'>View</a></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan='5'>
                                            <p class='text-center text-danger'>No transaction has been made!</p>
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