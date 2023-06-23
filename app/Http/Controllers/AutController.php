<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\Models\Account;
use App\Models\Referral;
use App\Models\Site_detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class AutController extends Controller
{
    public function register(Request $request)
    {
        // Validate submition
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required','unique:users'],
            'username' => ['required', 'unique:users']
        ]);

        
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password 
        ];
        
        if (User::create($input)) 
        {
            
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

        if(Auth::attempt($credentials))
            {
                $site = Site_detail::first();
                Mail::to(Auth::user()->email, Auth::user()->name)->send(new Welcome($site));
                Account::create([
                    'user_id' => Auth::user()->id
                ]);

                Referral::create([
                    'user_id' => Auth::user()->id,
                    'referred_by' => $request->referred_by,
                    'referral_id' => 'user-'.Str::random(10)
                ]);

                return redirect('/dashboard');
            }
        }

        return redirect()->back();      
    }

    public function login(Request $request)
    {
        // Validate submition
        $validate = $request->validate([
            'password' => 'required',
            'email' => ['required'],
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            if (Auth::user()->usertype === '1'){
                return redirect('/admins');
            }
            else {
                return redirect('/dashboard');
            }
        }

        return redirect()->back()->with('error','Incorrect email or password');  
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('error','Your are logged out');
    }
}
