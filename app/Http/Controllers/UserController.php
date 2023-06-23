<?php

namespace App\Http\Controllers;

use App\Mail\password_reset;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Message;
use App\Models\Notification;
use App\Models\password_reset_token;
use App\Models\Referral;
use App\Models\Site_detail;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function user_dash()
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id','=',Auth::user()->id)->where('status','=',0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $historys = Deposit::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->paginate(5);
        $investments = Investment::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id','=',Auth::user()->id)->where('status','=','active')->where('last_check','!=',today())->where('end_date','>=',today())->get();
        
        if (!empty($actives)){
            foreach ($actives as $active) {
                if (today() != $active->end_date){
                    $percent = $active->plan_percent;
                    $amount = $active->amount;
                    $day = today()->diffInDays($active->start_date);

                    $interest = ($amount * $percent * $day) / (100 * $active->duration);
                    $active->earned = $interest;
                    $active->last_check = today();
                    $active->save();
                }
                else{
                    $percent = $active->plan_percent;
                    $amount = $active->amount;
                    $day = today()->diffInDays($active->start_date);

                    $interest = ($amount*$percent*$day)/(100* $active->duration);
                    $active->earned = $interest;
                    $active->last_check = today();
                    $active->status = 'completed';
                    $active->save();

                    $total = $interest + $amount;

                    $balances = Account::where('user_id','=',Auth::user()->id)->get()->first();

                    $balance = $balances->balance;
                    $balances->balance = $balance + $total;
                    $balances->save();

                    $notice = [
                        'user_id' => Auth::user()->id,
                        'title' => 'Investment plan with ID '.$active->plan_id.' is completed',
                        'description' =>
                        'Investment plan with ID ' . $active->plan_id . ' is completed and has been settled accordingly. Amount is now available in your open balance.',
                    ];

                    Notification::create($notice);
                }
            }

            $earned = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '=', today())->sum('earned');

            $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
            $account->interest_earned = $earned;
            $account->save();
        }else{
            
        }

        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('user_dash.dashboard',compact('account','num_investments','all','investments','historys','notice'));
    }

    public function account()
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();
        return view('user_dash.account', compact('account', 'num_investments', 'all','notice'));
    }


    public function help()
    {
        $contact = Contact::first();
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();
        return view('user_dash.help', compact('account', 'num_investments', 'all','notice','contact'));
    }

    public function notice()
    {
        $notifications = Notification::orderby('created_at','DESC')->where('user_id','=',Auth::user()->id)->paginate(5);
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();
        return view('user_dash.notifications', compact('account', 'num_investments', 'all', 'notice','notifications'));
    }

    public function mark_all_as_read()
    {
        $notifications = Notification::where('user_id','=',Auth::user()->id)->where('status','=',0)->get();

        foreach ($notifications as $notification) {
            $notification->status = '1';
            $notification->save();
        }

        return redirect()->back();
    }

    public function read($id)
    {
        $notices = Notification::where('id','=',$id)->get()->first();
        $notices->status = '1';
        $notices->save();

        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();

        return view('user_dash.notice', compact('account', 'num_investments', 'all', 'notice', 'notices'));
    }

    public function inbox()
    {
        $tickets = Ticket::where('user_id', '=', Auth::user()->id)->get();
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();

        return view('user_dash.inbox', compact('account', 'num_investments', 'all', 'notice','tickets'));
    }

    public function new_message()
    {
        $user = User::where('id','=',Auth::user()->id)->get()->first();
        $tickets = Ticket::where('user_id','=',Auth::user()->id)->get();
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();

        return view('user_dash.new_msg', compact('account', 'num_investments', 'all', 'notice','tickets','user'));
    }

    public function create_msg(Request $request)
    {
        $ticket_id = 'tic-'.Str::random(10);
        $ticket = [
            'ticket_id' => $ticket_id,
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'title' => $request->title,
            'status' => 'open'
        ];
        Ticket::create($ticket);

        $mesage = [
            'ticket_id' => $ticket_id,
            'user_id' => Auth::user()->id,
            'message' => $request->message,
            'type' => 'sent'
        ];

        Message::create($mesage);

        return redirect()->back()->with('message','Ticket with id '.$ticket_id.' was created and response shall be sent soon');
    }

    public function message($id)
    {
        $ticket = Ticket::where('user_id', '=', Auth::user()->id)->where('ticket_id',$id)->get()->first();
        $messages = Message::orderby('created_at','DESC')->where('ticket_id','=',$id)->get();
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();

        return view('user_dash.message',compact('messages','notice','account','all','num_investments','actives','ticket'));
    }

    public function reply($id)
    {
        $user = User::where('id', '=', Auth::user()->id)->get()->first();
        $ticket = Ticket::where('user_id', '=', Auth::user()->id)->where('ticket_id', $id)->get()->first();
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();

        return view('user_dash.reply', compact('notice', 'account', 'all', 'num_investments', 'actives', 'ticket','user'));
    }

    public function process_reply(Request $request)
    {
        $input = [
            'ticket_id' => $request->ticket_id,
            'user_id' => Auth::user()->id,
            'type' => 'sent',
            'message' => $request->message
        ];
        Message::create($input);
        return redirect('/dashboard/support/ticket/inbox/'.$request->ticket_id);
    }

    public function referral()
    {
        $referral_id = Referral::where('user_id','=',Auth::user()->id)->get()->first()->referral_id;

        $referral = Referral::where('referred_by','=',$referral_id)->get();

        $referrals = [];

        foreach ($referral as $referral) {
            $user = User::where('id','=',$referral->user_id)->get()->first();
            $earned = Deposit::where('user_id','=', $referral->user_id)->where('status','=','approved')->sum('usd_amount');
            $earned = $earned/20;
            $info = [
            'username' => $user->username,
            'email' => $user->email,
            'joined' => $user->created_at,
            'earned' => $earned
            ];

            array_push($referrals,$info);
        }
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();

        return view('user_dash.referral', compact('account', 'num_investments', 'all', 'notice','referrals','referral_id'));
    }

    public function changepassword()
    {
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $actives = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->where('last_check', '!=', today())->where('end_date', '>=', today())->get();
        return view('user_dash.edit_password', compact('account', 'num_investments', 'all', 'notice'));
    }

    public function save_new_password(Request $request)
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

    public function reset_password()
    {
        $site = Site_detail::all()->first();
        $contact = Contact::all()->first();
        return view('home.reset', compact('site', 'contact'));
    }

    public function reset(Request $request)
    {
        $email = $request->email;
        
        if (!empty(User::where('email', '=', $email)->get()->first()))
        {
            $user = User::where('email', '=', $email)->get()->first();
            $site = Site_detail::first();
            $token = Str::random(60);

            $input = [
                'email' => $user->email,
                'token' => $token
            ];

            password_reset_token::create($input);
            Mail::to($user->email, $user->username)->send(new password_reset($site, $user->username,$token));

            return redirect()->back()->with('message','We have sent you a reset link. Check your inbox.');
        }
        else 
        {
            return redirect()->back()->with('error','You are not registered or check for error in your email address');
        }
    }

    public function reset_form($token)
    {
        $site = Site_detail::all()->first();
        $contact = Contact::all()->first();
        $reset = password_reset_token::where('token','=',$token)->get()->first();
        $current = Carbon::now();
        
        if (!empty($reset)){
            if ($current->diffInMinutes($reset->created_at) < 15)
            {
                $email = $reset->email;
                return view('home.reset_form', compact('site', 'contact','email'));
            }
            else {
                password_reset_token::where('token', '=', $token)->delete();
                return redirect('/reset_password')->with('error', 'Token has expired. Please try again.');
            }
            
        }else{
            return redirect('/reset_password')->with('error','Token is invalid. Please try again.');
        }
        
    }

    public function change_to_new_password(Request $request)
    {

        $validate = $request->validate([
            'password' => 'min:8'
        ]);

        if ($request->password === $request->password_confirm)
        {
            User::where('email','=',$request->email)->update([
                'password' => Hash::make($request->password)
            ]);
            password_reset_token::where('email', '=', $request->email)->delete();
            return redirect()->back()->with('message', 'Password Updated Successfully');
        }
        else {
            return redirect()->back()->with('error','Confirm password before you can proceed.');
        }
    }

}
