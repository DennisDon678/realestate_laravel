<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use App\Mail\Welcome;
use App\Models\Contact;
use App\Models\Site_detail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $site = Site_detail::all()->first();
    $contact = Contact::all()->first();
    return view('home.home', compact('site','contact'));
});
Route::get('/back', function () {
    return redirect('/');
});

Route::get('/about', function() {
    $site = Site_detail::all()->first();
    $contact = Contact::all()->first();
    return view('home.about', compact('site', 'contact'));
});

Route::get('/login', function () {
    $site = Site_detail::all()->first();
    $contact = Contact::all()->first();
    return view('home.login', compact('site', 'contact'));
});

Route::get('/register', function () {
    $site = Site_detail::all()->first();
    $contact = Contact::all()->first();
    return view('home.register', compact('site', 'contact'));
});

Route::post('/login', [AutController::class, 'login']);
Route::get('/reset_password',[UserController::class,'reset_password']);
Route::post('/reset_password',[UserController::class,'reset']);
Route::post('/reset',[UserController::class,'change_to_new_password']);
Route::get('/reset/{token}',[UserController::class,'reset_form']);
Route::post('/register', [AutController::class, 'register']);
Route::post('/logout', [AutController::class, 'logout']);

Route::get('/dashboard',[UserController::class,'user_dash'])->middleware('auth');
Route::get('/dashboard/account',[UserController::class,'account'])->middleware('auth');
Route::get('/dashboard/help', [UserController::class, 'help'])->middleware('auth');
Route::get('/dashboard/paid/{id}',[PropertyController::class,'paid'])->middleware('auth');
Route::get('/dashboard/notifications',[UserController::class,'notice'])->middleware('auth');
Route::get('/dashboard/notifications/all',[UserController::class,'mark_all_as_read'])->middleware('auth');
Route::get('/dashboard/notifications/{id}', [UserController::class, 'read'])->middleware('auth');
Route::get('/dashboard/support/inbox',[UserController::class,'inbox'])->middleware('auth');
Route::get('/dashboard/support/new',[UserController::class,'new_message'])->middleware('auth');
Route::post('/dashboard/tickets/new',[UserController::class,'create_msg'])->middleware('auth');
Route::get('/dashboard/support/ticket/inbox/{id}',[UserController::class,'message'])->middleware('auth');
Route::get('/dashboard/support/ticket/inbox/{id}/reply',[UserController::class,'reply'])->middleware('auth');
Route::post('/dashboard/tickets/reply',[UserController::class,'process_reply'])->middleware('auth');
Route::get('/dashboard/referral',[UserController::class,'referral'])->middleware('auth');
Route::get('/dashboard/account/password/edit',[UserController::class,'changepassword'])->middleware('auth');
Route::post('/dashboard/account/password/edit',[UserController::class,'save_new_password'])->middleware('auth');

// Finance
Route::get('/dashboard/deposit',[FinanceController::class,'deposit_form'])->middleware('auth');
Route::get('/dashboard/deposit/crypto', [FinanceController::class, 'crypto_deposit_form'])->middleware('auth');
Route::get('/dashboard/deposit/cash', [FinanceController::class, 'cash_deposit_form'])->middleware('auth');
Route::get('/dashboard/withdraw', [FinanceController::class, 'withdraw_form'])->middleware('auth');
Route::post('/dashboard/deposit', [FinanceController::class, 'create_deposit'])->middleware('auth');
Route::get('/dashboard/deposit/{order_id}', [FinanceController::class, 'details'])->middleware('auth');
Route::post('/dashboard/withdraw', [FinanceController::class, 'create_withdrawal'])->middleware('auth');

// Property
Route::get('/dashboard/buy',[PropertyController::class,'buy_list'])->middleware('auth');
Route::get('/dashboard/rent', [PropertyController::class, 'rent_list'])->middleware('auth');
Route::get('/dashboard/invest', [PropertyController::class, 'invest_list'])->middleware('auth');
Route::get('/dashboard/invest/{id}', [PropertyController::class, 'invest_lists'])->middleware('auth');
Route::get('/dashboard/investments', [PropertyController::class, 'investments'])->middleware('auth');
Route::get('/create_property_for_sell',[PropertyController::class,'create_for_sell']);
Route::get('/create_property_for_rent', [PropertyController::class, 'create_for_rent']);
Route::get('/create_property_for_investment', [PropertyController::class, 'create_investment']);
Route::get('/dashboard/invests/create', [PropertyController::class, 'invest_form'])->middleware('auth');
Route::post('/dashboard/invest/create', [PropertyController::class, 'invest_create'])->middleware('auth');
Route::get('/dashboard/buy/{zip}',[PropertyController::class,'more_on_buy'])->middleware('auth');
Route::get('/dashboard/rent/{zip}', [PropertyController::class, 'more_on_rent'])->middleware('auth');
Route::get('/dashboard/buy/contact/{id}', [PropertyController::class, 'check_buy'])->middleware('auth');
Route::get('/dashboard/rent/contact/{id}',[PropertyController::class, 'check_rent'])->middleware('auth');
Route::get('/dashboard/property/history',[PropertyController::class,'prop_history'])->middleware('auth');
Route::get('/dashboard/paid/{id}', [PropertyController::class, 'paid'])->middleware('auth');

// Admins
Route::get('/admins',[AdminController::class,'dashboard'])->middleware('admin');
Route::get('/admins/approve',[AdminController::class, 'approve'])->middleware('admin');
Route::get('/admins/reject', [AdminController::class, 'reject'])->middleware('admin');
Route::get('/admins/withdraw',[AdminController::class,'view_withdrawal'])->middleware('admin');
Route::post('/admins/withdraw/approve',[AdminController::class, 'approve_withdrawal'])->middleware('admin');
Route::post('/admins/withdraw/reject',[AdminController::class,'reject_withdrawal'])->middleware('admin');
Route::get('/admins/users',[AdminController::class,'users'])->middleware('admin');
Route::post('/admins/users',[AdminController::class,'search'])->middleware('admin');
Route::get('/admins/send_message',[AdminController::class,'email_user'])->middleware('admin');
Route::post('/admins/send_message',[AdminController::class,'send_email'])->middleware('admin');
Route::get('/admins/delete',[AdminController::class,'delete_user'])->middleware('admin');
Route::get('/admins/deposit',[AdminController::class,'deposit_methods'])->middleware('admin');
Route::get('/admins/deposit/edit',[AdminController::class,'edit_deposit_method'])->middleware('admin');
Route::post('/admins/deposit/edit', [AdminController::class,'save_deposit_method'])->middleware('admin');
Route::get('/admins/deposit/add',[AdminController::class,'add_deposit_method'])->middleware('admin');
Route::post('/admins/deposit/add', [AdminController::class, 'save_new_deposit_method'])->middleware('admin');
Route::get('/admins/deposit/delete',[AdminController::class,'delete_deposit'])->middleware('admin');
Route::get('/admins/contacts', [AdminController::class, 'contact'])->middleware('admin');
Route::post('/admins/contact',[AdminController::class,'upadate_contact'])->middleware('admin');
Route::get('/admins/investments',[AdminController::class,'set_plans'])->middleware('admin');
Route::post('/admins/plans',[AdminController::class,'update_plan'])->middleware('admin');
Route::get('/admins/inbox',[AdminController::class,'inbox'])->middleware('admin');
Route::get('/admins/inbox/{id}', [AdminController::class, 'inbox_detail'])->middleware('admin');
Route::get('/admins/site',[AdminController::class,'site'])->middleware('admin');
Route::post('/admins/site',[AdminController::class,'change_name'])->middleware('admin');
Route::get('/admins/inbox/{id}/reply',[AdminController::class,'reply'])->middleware('admin');
Route::post('/admins/inbox/reply',[AdminController::class,'save_reply'])->middleware('admin');
Route::get('admins/account',[AdminController::class,'account'])->middleware('admin');
Route::get('/admins/change_password',[AdminController::class,'change_password'])->middleware('admin');
Route::post('/admins/change_password', [AdminController::class, 'renew'])->middleware('admin');
Route::get('/admins/edit/profile',[AdminController::class,'edit_profile'])->middleware('admin');
Route::post('/admins/edit/profile', [AdminController::class, 'save_profile'])->middleware('admin');
Route::get('/admins/edit',[AdminController::class,'edit_user_form'])->middleware('admin');
Route::post('/admins/edit', [AdminController::class, 'edit_user'])->middleware('admin');