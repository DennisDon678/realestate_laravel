@include('user_dash.components.head')
@include('user_dash.components.nav')
@include('user_dash.components.sidebar')

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Referral</h1>

        @include('user_dash.components.finance')

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card p-4">
                <p>Referral link:</p>
                <input id="" name="email" type="email" class="form-control " value="{{Url('/register')}}?referral_id={{$referral_id}}" readonly>
                <small class="text-primary">Get 5% of your referral's successfull deposit</small>
            </div>
            <hr>
                <div class="app-card p-4 app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover table-responsive mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Username</th>
                                        <th class="cell">Email</th>
                                        <th class="cell">Earned</th>
                                        <th class="cell">Joined</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(count($referrals) > 0)
                                    @foreach($referrals as $referral)
                                    <tr>
                                        <td class="cell">{{$referral['username']}}</td>
                                        <td class="cell"><span class="truncate">{{$referral['email']}}</span></td>
                                        <td class="cell">${{number_format($referral['earned'],2)}}</td>
                                        <td class="cell">{{$referral['joined']}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan='5'>
                                            <p class='text-center text-danger'>No Referral Yet</p>
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