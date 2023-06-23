<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Open Balance</h4>
                <div class="stats-figure">${{number_format($account->balance,2)}}</div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Interest Earned</h4>
                <div class="stats-figure">${{number_format($account->interest_earned,2)}}</div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Active Investments</h4>
                <div class="stats-figure">{{$num_investments}}</div>
                <div class="stats-meta">
                    Open</div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="/dashboard/investments"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">All Investments</h4>
                <div class="stats-figure">{{$all}}</div>
            </div>
            <!--//app-card-body-->
            <a class="app-card-link-mask" href="/dashboard/investments"></a>
        </div>
        <!--//app-card-->
    </div>
    <!--//col-->
</div>