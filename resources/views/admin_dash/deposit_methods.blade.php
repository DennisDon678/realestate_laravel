@include('admin_dash.components.head')
@include('admin_dash.components.nav')
@include('admin_dash.components.sidebar')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Deposit Methods</h1>

        @include('admin_dash.components.info')

        <div class="add mb-3 me-0">
        <a href="/admins/deposit/add" class="btn app-btn-primary" alt="Add method">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
        </svg>
        </a>
        </div>
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            @if (Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover table-responsive mb-1 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Coin</th>
                                        <th class="cell">Wallet</th>
                                        <th class="cell">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(count($deposits) > 0)
                                    @foreach($deposits as $deposit)
                                    <tr>
                                        <td class="cell">{{$deposit->coin}}</td>
                                        <td class="cell"><span class="truncate">{{$deposit->wallet}}</span></td>
                                        <td class="cell">
                                        <a href="/admins/deposit/edit?method_id={{$deposit->id}}" class="btn app-btn-primary mb-1 mb-md-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z" />
                                            </svg></a>
                                        
                                        <a href="/admins/deposit/delete?method_id={{$deposit->id}}" class="btn app-btn btn-danger" style="color:white;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg></a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan='3'>
                                            <p class='text-center text-danger'>No Deposit method Has been created yet</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{$deposits->links('pagination::bootstrap-5')}}
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