<?php

namespace App\Http\Controllers;

use App\Mail\approved_deposit;
use App\Mail\direct;
use App\Mail\rejected_deposit;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Deposit;
use App\Models\Deposit_address;
use App\Models\Investment;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Plan_rate;
use App\Models\Referral;
use App\Models\Site_detail;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $withdrawals = Withdrawal::where('status', '=', 'pending')->get();
        $pendings = Deposit::where('status','=','pending')->get();
        $users = User::where('usertype','=',0)->get();
        $investments = Investment::where('status','=','active')->get();
        return view('admin_dash.dashboard', compact('users','investments','pendings', 'withdrawals'));
    }

    public function approve(Request $request)
    {
        // Get pending
        $deposit = Deposit::where('transaction_id','=',$request->transaction_id)->get()->first();
        // Get user
        $user = $deposit->user_id;
        // Get Account
        $account = Account::where('user_id','=',$user)->get()->first();
        // Add balance
        $balance = $deposit->usd_amount + $account->balance;

        $account->balance = $balance;
        $deposit->status = 'approved';
        $deposit->save();
        $account->save();

        // Get referree
        $referree_id = Referral::where('user_id', '=', $user)->get()->first()->referred_by;
        $referree =  Referral::where('referral_id', '=', $referree_id)->get()->first()->user_id;
        $account = Account::where('user_id', '=', $referree)->get()->first();

        $balance = ($deposit->usd_amount)/20 + $account->balance;
        $account->balance = $balance;
        $account->save();

        
        $notice = [
            'user_id' => $user,
            'title' => 'Deposit in the amount of USD' . $deposit->usd_amount. ' has been approved',
            'description' => 'This is to notify you thatbyour pending deposit in the amount of USD' . $deposit->usd_amount . ' has been reviewed and approved by our team. Thanks for being with us.'
        ];

        $user = User::where('id','=',$user)->get()->first();
        $site = Site_detail::first();
        Mail::to($user->email,$user->username)->send(new approved_deposit($site,$user->username,$deposit->usd_amount));

        Notification::create($notice);
        return redirect()->back();
    }

    public function reject(Request $request)
    {
        // Get pending
        $deposit = Deposit::where('transaction_id', '=', $request->transaction_id)->get()->first();
        // Get user
        $user = $deposit->user_id;
        $deposit->status = 'rejected';
        $deposit->save();

        $notice = [
            'user_id' => $user,
            'title' => 'Deposit in the amount of USD' . $deposit->usd_amount . ' has been rejected',
            'description' => 'This is to notify you that your pending deposit in the amount of USD' . $deposit->usd_amount . ' has been reviewed and rejected by our team, this could be that we could not confirm the transaction. Please contact the support for assistance if this is an error from us. Thanks for being with us.'
        ];

        Notification::create($notice);

        $user = User::where('id', '=', $user)->get()->first();
        $site = Site_detail::first();
        Mail::to($user->email, $user->username)->send(new rejected_deposit($site,$user->username,$deposit->usd_amount));
        return redirect()->back();
    }

    public function view_withdrawal(Request $request) 
    {
        $withdrawal = Withdrawal::where('transaction_id','=',$request->transaction_id)->get()->first();
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        return view('admin_dash.withdrawal', compact('users','investments','withdrawal'));
    }

    public function approve_withdrawal(Request $request)
    {
        $withdrawal = Withdrawal::where('transaction_id','=',$request->transaction_id)->get()->first();
        $withdrawal->status = 'approved';

        $account = Account::where('user_id', '=', $withdrawal->user_id)->get()->first();

        $balance = $account->balance - $withdrawal->amount;

        $account->balance = $balance;
        $account->save();
        $withdrawal->save();

        $notice = [
            'user_id' => $withdrawal->user_id,
            'title' => 'Withdrawal in the amount of USD' . $withdrawal->amount . ' has been approved',
            'description' => 'This is to notify you that your pending withdrawal in the amount of USD' . $withdrawal->amount . ' has been reviewed and approved by our team. Thanks for being with us.'
        ];

        Notification::create($notice);

        return redirect()->back()->with('message','Withdrawal Approved, You can head back to Overview.');
    }

    public function reject_withdrawal(Request $request)
    {
        $withdrawal = Withdrawal::where('transaction_id', '=', $request->transaction_id)->get()->first();
        $withdrawal->status = 'rejected';
        $withdrawal->save();

        $notice = [
            'user_id' => $withdrawal->user_id,
            'title' => 'Withdrawal in the amount of USD' . $withdrawal->amount . ' has been rejected',
            'description' => 'This is to notify you that your pending withdrawal in the amount of USD' . $withdrawal->amount . ' has been reviewed and rejected by our system. Please Contact the support for assistance. Thanks for being with us.'
        ];
        Notification::create($notice);

        return redirect()->back()->with('message', 'Withdrawal rejected, You can head back to Overview.');
    }

    public function users()
    {
        $users = User::where('usertype', '=', 0)->paginate(10);
        $investments = Investment::where('status', '=', 'active')->get();

        return view('admin_dash.users', compact('users','investments'));
    }

    public function delete_user(Request $request)
    {
        $user = User::where('id','=',$request->user_id)->get()->first();

        $user->delete();
        return redirect()->back()->with('message', 'Selected User has been deleted.');
    }

    public function deposit_methods()
    {
        $users = User::where('usertype', '=', 0)->paginate(10);
        $investments = Investment::where('status', '=', 'active')->get();
        $deposits = Deposit_address::orderby('created_at','DESC')->paginate(10);

        return view('admin_dash.deposit_methods', compact('users', 'investments','deposits'));
    }

    public function edit_deposit_method(Request $request)
    {
        $users = User::where('usertype', '=', 0)->paginate(10);
        $investments = Investment::where('status', '=', 'active')->get();
        $deposit = Deposit_address::where('id','=',$request->method_id)->get()->first();

        return view('admin_dash.edit_deposit_method', compact('users','investments','deposit'));
    }

    public function save_deposit_method(Request $request)
    {
        $method = Deposit_address::where('id','=',$request->method_id)->get()->first();

        $method->coin = $request->coin;
        $method->wallet = $request->wallet;

        $method->save();

        return redirect()->back()->with('message', 'Wallet Updated.');
    }

    public function add_deposit_method()
    {
        $users = User::where('usertype', '=', 0)->paginate(10);
        $investments = Investment::where('status', '=', 'active')->get();

        return view('admin_dash.add_deposit_method', compact('users','investments'));
    }

    public function save_new_deposit_method(Request $request)
    {
        $input = [
            'coin' => $request->coin,
            'wallet' => $request->wallet
        ];

        Deposit_address::create($input);
        return redirect('/admins/deposit')->with('message','New method has been created.');
    }

    public function delete_deposit(Request $request)
    {
        $address = Deposit_address::where('id','=',$request->method_id)->get()->first();
        $address->delete();
        return redirect()->back()->with('message','Deposit Method has been Deleted');
    }

    public function contact()
    {
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        $contact = Contact::all()->first();
        
        return view('admin_dash.contact', compact('users','investments','contact'));
    }

    public function upadate_contact(Request $request)
    {
        $contact = Contact::all()->first();
        $contact->whatsapp = $request->whatsapp;
        $contact->telegram = $request->telegram;
        $contact->email = $request->email;
        $contact->save();
        return redirect()->back()->with('message','Contact has been updated.');
    }

    public function set_plans()
    {
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        $simple = Plan_rate::where('plan_type','=',1)->get()->first();
        $short = Plan_rate::where('plan_type', '=', 2)->get()->first();
        $long = Plan_rate::where('plan_type', '=', 3)->get()->first();

        return view('admin_dash.plans', compact('users', 'investments','simple','short','long'));
    }

    public function update_plan(Request $request)
    {
        if ($request->type == 1)
        {
            $plan = Plan_rate::where('plan_type','=', $request->type)->get()->first();

            $plan->basic_min = $request->min;
            $plan->basic_max = $request->max;
            $plan->basic_percent = $request->percent;
            $plan->elite_min = $request->min1;
            $plan->elite_max = $request->max1;
            $plan->elite_percent = $request->percent1;
            $plan->pro_min = $request->min2;
            $plan->pro_percent = $request->percent2;
            
            $plan->save();

            return redirect()->back()->with('message1','Plan Updated Successful');
        }elseif($request->type == 2)
        {
            $plan = Plan_rate::where('plan_type', '=', $request->type)->get()->first();

            $plan->basic_min = $request->min;
            $plan->basic_max = $request->max;
            $plan->basic_percent = $request->percent;

            $plan->save();

            return redirect()->back()->with('message2', 'Plan Updated Successful');

        }elseif($request->type == 3)
        {
            $plan = Plan_rate::where('plan_type', '=', $request->type)->get()->first();

            $plan->basic_min = $request->min;
            $plan->basic_max = $request->max;
            $plan->basic_percent = $request->percent;
            $plan->save();
            return redirect()->back()->with('message3', 'Plan Updated Successful');

        }
    }

    public function inbox()
    {
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        $tickets = Ticket::all();

        return view('admin_dash.inbox', compact('users','investments', 'tickets'));
    }

    public function inbox_detail($id)
    {
        $ticket = Ticket::where('ticket_id','=',$id)->get()->first();
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        $messages = Message::orderby('created_at', 'DESC')->where('ticket_id', '=', $id)->get();
        return view('admin_dash.message', compact('users', 'investments', 'messages','ticket'));
    }

    public function site()
    {
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        $site = Site_detail::all()->first();
        return view('admin_dash.site', compact('users', 'investments','site'));
    }

    public function change_name(Request $request)
    {
        $site = Site_detail::all()->first();
        $site->site_name = $request->name;
        $site->save();
        
        return redirect()->back()->with('message','Site Name Updated.');
    }

    public function reply($id)
    {
        $users = User::where('usertype', '=', 0)->get();
        $investments = Investment::where('status', '=', 'active')->get();
        $ticket = Ticket::where('ticket_id','=',$id)->get()->first();
        $user = User::where('id','=',$ticket->user_id)->get()->first();
        return view('admin_dash.reply', compact('users', 'investments','user','ticket'));
    }

    public function save_reply(Request $request)
    {
        $ticket = Ticket::where('ticket_id','=',$request->ticket_id)->get()->first();
        $input = [
            'ticket_id' => $request->ticket_id,
            'user_id' => $ticket->user_id,
            'type' => 'reply',
            'message' => $request->message
        ];
        Message::create($input);

        $notice = [
            'user_id' => $ticket->user_id,
            'title' => 'You have a new message. on ticket '. $request->ticket_id,
            'description' => 'Our support team just sent you a new message'
        ];
        Notification::create($notice);
        return redirect('/admins/inbox/' . $request->ticket_id);
    }

    public function search(Request $request)
    {
        $user = User::where('email','=',$request->user)->orWhere('username','=',$request->user)->get()->first();
        $users = User::where('usertype', '=', 0)->paginate(10);
        $investments = Investment::where('status', '=', 'active')->get();

        return view('admin_dash.user', compact('users', 'investments','user'));
    }

    public function email_user (Request $request)
    {
        $user = User::where('id', '=', $request->user_id)->get()->first();
        $users = User::where('usertype', '=', 0)->paginate(10);
        $investments = Investment::where('status', '=', 'active')->get();

        return view('admin_dash.send_mail', compact('users', 'investments', 'user'));
    }

    public function send_email(Request $request)
    {
        $site = Site_detail::first();
        $email = $request->email;
        $title = $request->title;
        $message = $request->message;

        $username = User::where('email','=',$email)->get()->first()->username;
    

        if (Mail::to($email, $username)->send(new direct($site, $username, $title, $message)))
        {
            return redirect()->back()->with('message','Message sent successfully');
        }
        else
        {
            return redirect()->back()->with('error','Message not sent, please try again');
        }
    }

    public function account()
    {
        return view('admin_dash.account');
    }

    public function change_password()
    {
        return view('admin_dash.edit_password');
    }

    public function renew(Request $request)
    {
        $validate = $request->validate([
            'new' => 'min:8'
        ]);

        if (!Hash::check($request->old, Auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new)
        ]);

        return back()->with("message", "Password changed successfully!");
    }

    public function edit_profile()
    {
        return view('admin_dash.edit_profile');
    }

    public function save_profile(Request $request)
    {
        $user = User::where('id','=', Auth::user()->id)->get()->first();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return back()->with("message", "Profile has been updated!");
    }
}
