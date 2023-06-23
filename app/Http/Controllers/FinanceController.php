<?php

namespace App\Http\Controllers;

use App\Mail\Pending_deposit;
use App\Models\Account;
use App\Models\Deposit;
use App\Models\Deposit_address;
use App\Models\Finance;
use App\Models\Investment;
use App\Models\Notification;
use App\Models\Site_detail;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class FinanceController extends Controller
{
    // Deposit form
    public function deposit_form(Request $request)
    {
        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $historys = Deposit::where('user_id','=',Auth::user()->id)->get();
        $num_investments = Investment::where('user_id','=',Auth::user()->id)->where('status','=','active')->get()->count();

        $user = Auth::user();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $deposit_options = Deposit_address::all();

        if (isset($request->amount) and isset($request->coin)) {

            $response = Http::withHeaders([
                'x-api-key' => 'KCX2RBP-RYBMH20-PS8KXRQ-05PT5Q5',
                'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
                'X-RapidAPI-Host' => 'nowpayments.p.rapidapi.com'
            ])->get('https://nowpayments.p.rapidapi.com/v1/estimate', [
                'currency_to' => $request->coin,
                'currency_from' => 'usd',
                'amount' => $request->amount
            ]);

            $details = Deposit_address::where('coin', '=', $request->coin)->get()->first();
            $deposit = [
                'coin' => $details->coin,
                'amount' => $response['estimated_amount'],
                'address' => $details->wallet
            ];


            return view('user_dash.deposit', compact('account', 'user', 'deposit','historys','num_investments','all','notice'));
        }
        return view('user_dash.fund', compact('account', 'user','deposit_options', 'historys','num_investments','all','notice'));
    }

    public function withdraw_form()
    {
        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $withdrawals = Withdrawal::where('user_id', '=', Auth::user()->id)->get();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();

        $user = Auth::user();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('user_dash.withdraw', compact('account', 'user','num_investments','all','withdrawals','notice'));
    }

    public function create_deposit(Request $request)
    {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('pending_images'), $imageName);

        $url = 'pending_images/' . $imageName;
        $amount = $request->amount;
        $coin = $request->coin;
        $wallet = $request->wallet;
        $trans_id = 'fin-' . Str::random(10);

        $input = [
            'transaction_id' => $trans_id,
            'user_id' => Auth::user()->id,
            'wallet_address' => $wallet,
            'coin' => $coin,
            'coin_amount' => $amount,
            'usd_amount' => $request->usd,
            'url' => $url,
            'status' => 'pending'
        ];

        $finance = [
            'transaction_id' =>
            $trans_id,
            'user_id' =>
            Auth::user()->id,
            'type' => 'withdrawal',
            'status' => 'pending',
            'amount' =>
            $request->usd
        ];

        $notice = [
            'user_id' => Auth::user()->id,
            'title' => 'A pending Deposit in the amount of USD'.$request->usd,
            'description' => 'This is to notify you of a pending deposit in the amount of USD'. $request->usd.'. Our finance team shall look through and validate it in few hours.'
        ];

        Deposit::create($input);
        Finance::create($finance);
        Notification::create($notice);
        $site = Site_detail::first();
        Mail::to(Auth::user()->email,Auth::user()->username)->send(new Pending_deposit($site,Auth::user()->username, $request->usd));

        return redirect()->back()->with('message','Deposit received and is under review');
    }

    public function details($order_id)
    {
        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $deposit = Deposit::where('transaction_id', '=', $order_id)->get()->first();
        return view('user_dash.details', compact('deposit', 'account','num_investments','all','notice'));
    }


    public function create_withdrawal(Request $request)
    {
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $balance = Account::where('user_id', '=', Auth::user()->id)->get('balance')->first();

        if ($balance['balance'] > $request->amount) {
            // Main
            $trans_id = "fin-" . Str::random(10);
            $input = [
                'user_id' =>
                Auth::user()->id,
                'transaction_id' => $trans_id,
                'amount' => $request->amount,
                'method' => $request->method,
                'wallet' => $request->wallet,
                'status' => 'pending'
            ];

            $finance = [
                'transaction_id' =>
                $trans_id,
                'user_id' =>
                Auth::user()->id,
                'type' => 'withdrawal',
                'status' => 'pending',
                'amount' =>
                $request->amount
            ];

            Withdrawal::create($input);
            Finance::create($finance);

            return redirect('/dashboard/withdraw')->with('message', 'Withdrawal request has been submitted');
        } else {
            return redirect('/dashboard/withdraw')->with('error', "Amount cant't be more than open balance");
        }
    }

    public function crypto_deposit_form(Request $request)
    {
        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $historys = Deposit::where('user_id', '=', Auth::user()->id)->get();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();

        $user = Auth::user();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $deposit_options = Deposit_address::all();

        if (isset($request->amount) and isset($request->coin)) {

            $response = Http::withHeaders([
                'x-api-key' => 'KCX2RBP-RYBMH20-PS8KXRQ-05PT5Q5',
                'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
                'X-RapidAPI-Host' => 'nowpayments.p.rapidapi.com'
            ])->get('https://nowpayments.p.rapidapi.com/v1/estimate', [
                'currency_to' => $request->coin,
                'currency_from' => 'usd',
                'amount' => $request->amount
            ]);

            $details = Deposit_address::where('coin', '=', $request->coin)->get()->first();
            $deposit = [
                'coin' => $details->coin,
                'amount' => $response['estimated_amount'],
                'address' => $details->wallet
            ];
            return view('user_dash.deposit', compact('account', 'user', 'deposit', 'historys', 'num_investments', 'all','notice'));
        }
        return view('user_dash.deposit', compact('account', 'user', 'deposit_options', 'historys', 'num_investments', 'all','notice'));
    }

    public function cash_deposit_form()
    {
        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $historys = Deposit::where('user_id', '=', Auth::user()->id)->get();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();

        $user = Auth::user();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $deposit_options = Deposit_address::all();

        return view('user_dash.deposit_cash', compact('account', 'user', 'deposit_options', 'historys', 'num_investments', 'all','notice'));
    }
}
