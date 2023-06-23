<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\For_rent;
use App\Models\For_sell;
use App\Models\Investment;
use App\Models\Investment_list;
use App\Models\Notification;
use App\Models\paid_buy;
use App\Models\Plan_rate;
use App\Models\Plan_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PropertyController extends Controller
{
    //
    public function buy_list()
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $listings = For_sell::orderBy('created_at', 'DESC')->paginate(6);
        return view('user_dash.buy',compact('listings','account','num_investments','all','notice'));
    }

    public function rent_list()
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $listings = For_rent::orderBy('created_at', 'DESC')->paginate(6);
        return view('user_dash.rent', compact('listings','account','num_investments','all','notice'));
    }

    public function invest_lists($id)
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $plans = Investment_list::paginate(6);
        $type = Plan_rate::where('plan_type','=',$id)->get()->first();
        return view('user_dash.invest',compact('account','plans','num_investments','all','notice','type'));
    }

    public function invest_list()
    {
        $notice = Notification::orderby('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $plans = Plan_type::all();
        return view('user_dash.invest_type', compact('account', 'plans', 'num_investments', 'all', 'notice'));
    }

    public function investments()
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $investments = Investment::where('user_id','=',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('user_dash.investments',compact('account','investments','num_investments','all','notice'));
    }

    public function create_for_sell()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
            'X-RapidAPI-Host' => 'realtor.p.rapidapi.com'
        ])->post('https://realtor.p.rapidapi.com/properties/v3/list',[
                'limit' => 200,
                'offset' => 0,
                'postal_code' => '90004',
                'status' => [
                'for_sale',
                'ready_to_build'
                ],
                'sort' => [
                    'direction' => 'desc',
                    'field' => 'list_date'
                ]
        ])['data']['home_search']['results'];

        
    foreach ($response as $key => $value) {
        if ($key <= 10) {
            if (isset($value['description']['beds'])){
                $property_id = $value['property_id'];
                $address = $value['location']['address']['line'];
                $city = $value['location']['address']['city'];
                $photo = $value['primary_photo']['href'];
                $photo = str_replace('.jpg', '-w480_h360_x2.webp?w=640&q=75',$photo);
                $price = $value['list_price'];
                $size = $value['description']['sqft'];
                $bed = $value['description']['beds'];
                $address = $address.', '.$city;

                $input = [
                    'name' => 'for_sell',
                    'property_id' => $property_id,
                    'address' => $address,
                    'price' => $price,
                    'image1' => $photo,
                    'size' => $size,
                    'bedrooms' => $bed
                ];

                For_sell::create($input);
            } 
        }
    }
    }

    public function create_for_rent()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
            'X-RapidAPI-Host' => 'realtor.p.rapidapi.com'
        ])->post('https://realtor.p.rapidapi.com/properties/v3/list', [
            'limit' => 200,
            'offset' => 0,
            'postal_code' => '90004',
            'status' => [
                'for_rent',
                'ready_to_build'
            ],
            'sort' => [
                'direction' => 'desc',
                'field' => 'list_date'
            ]
        ])['data']['home_search']['results'];


        foreach ($response as $key => $value) {
            if ($key <= 10) {
                if (isset($value['description']['beds']) and $value['primary_photo'] != null) {
                    $property_id = $value['property_id'];
                    $address = $value['location']['address']['line'];
                    $city = $value['location']['address']['city'];
                    $photo = $value['primary_photo']['href'];
                    $photo = str_replace('.jpg', '-w480_h360_x2.webp?w=640&q=75', $photo);
                    $price = $value['list_price'];
                    $size = $value['description']['sqft'];
                    $bed = $value['description']['beds'];
                    $address = $address . ', ' . $city;

                    $input = [
                        'name' => 'for_sell',
                        'property_id' => $property_id,
                        'address' => $address,
                        'price' => $price,
                        'image1' => $photo,
                        'size' => $size,
                        'bedrooms' => $bed
                    ];

                    For_rent::create($input);
                }
            }
        }
    }


    public function invest_form(Request $request)
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $plan_id = $request->plan_id;
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $plan = Investment_list::where('plan_id', '=', $request->plan_id)->get()->first();
        $rate = Plan_rate::where('plan_type','=',$request->plan_type)->get()->first();
        return view('user_dash.create_investment',compact('plan_id','account','plan','num_investments','all','notice','rate'));
    }

    public function invest_create(Request $request)
    {
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        $plan = Plan_rate::where('plan_type','=',$request->plan_type)->get()->first();

        $basic_min = $plan->basic_min;
        $basic_max = $plan->basic_max;
        $basic_percent = $plan->basic_percent;
        $elite_min = $plan->elite_min;
        $elite_max = $plan->elite_max;
        $elite_percent = $plan->elite_percent;
        $pro_min = $plan->pro_min;
        $pro_percent = $plan->pro_percent;

        
        if ($request->amount <= $account->balance) {
            
            $plan_id = $request->plan_id;
            $plan = $request->plan;
            $duration = $request->duration;
            $amount = $request->amount;
            if ($plan === $basic_percent){
                if ($plan === $basic_percent and $amount >= $basic_min and $amount <= $basic_max) {
                    $input = [
                        'plan_id' => $plan_id,
                        'plan_percent' => $plan,
                        'duration' => $duration,
                        'status' => 'active',
                        'start_date' => today(),
                        'end_date' => today()->addDays($duration),
                        'last_check' => today(),
                        'amount' => $amount,
                        'earned' => 0,
                        'user_id' => Auth::user()->id
                    ];

                    if (Investment::create($input)) {
                        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
                        $balance = $account->balance;

                        $new_bal = $balance - $request->amount;
                        $account->balance = $new_bal;

                        $account->save();

                        $notice = [
                            'user_id' => Auth::user()->id,
                            'title' => 'A new investment has been created.',
                            'description' => 'A new investment has been created in the form of USD' . $request->amount . ' at the rate of '.$plan.'%. Thanks.'
                        ];

                        Notification::create($notice);
                    }

                    return redirect()->back()->with('message', 'Investment Has been received and processed');
                } else {
                    return redirect()->back()->with('error', 'Amount do not meet the basic plan requirement');
                }
            }
            
            if ($plan === $elite_percent){
                if ($plan === $elite_percent and $amount >= $elite_min and $amount <= $elite_max) {
                    $input = [
                        'plan_id' => $plan_id,
                        'plan_type' => $plan,
                        'duration' => $duration,
                        'status' => 'active',
                        'earned' => 0,
                        'amount' => $amount,
                        'user_id' => Auth::user()->id
                    ];

                    if (Investment::create($input)) {
                        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
                        $balance = $account->balance;

                        $new_bal = $balance - $request->amount;
                        $account->balance = $new_bal;

                        $account->save();

                        $notice = [
                            'user_id' => Auth::user()->id,
                            'title' => 'A new investment has been created.',
                            'description' => 'A new investment has been created in the form of USD' . $request->amount . ' at the rate of ' . $plan . '%. Thanks.'
                        ];

                        Notification::create($notice);
                    }
                    return redirect()->back()->with('message', 'Investment Has been received and processed');
                } else {
                    return redirect()->back()->with('error', 'Amount do not meet the elite plan requirement');
                }
            }

            if($plan === $pro_percent){
                if ($plan === $pro_percent and $amount >= $pro_min) {
                    $input = [
                        'plan_id' => $plan_id,
                        'plan_type' => $plan,
                        'duration' => $duration,
                        'status' => 'active',
                        'earned' => 0,
                        'amount' => $amount,
                        'user_id' => Auth::user()->id
                    ];

                    if (Investment::create($input)) {
                        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
                        $balance = $account->balance;

                        $new_bal = $balance - $request->amount;
                        $account->balance = $new_bal;

                        $account->save();

                        $notice = [
                            'user_id' => Auth::user()->id,
                            'title' => 'A new investment has been created.',
                            'description' => 'A new investment has been created in the form of USD' . $request->amount . ' at the rate of ' . $plan . '%. Thanks.'
                        ];

                        Notification::create($notice); 
                    }
                    return redirect()->back()->with('message', 'Investment Has been received and processed');
                } else {
                    return redirect()->back()->with('error', 'Amount do not meet the pro plan requirement');
                }
            }
        }else{
            return redirect()->back()->with('error','Insufficent Balance');
        }
        
    }

    public function more_on_buy($zpid)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
            'X-RapidAPI-Host' => 'realtor.p.rapidapi.com'
        ])->get('https://realtor.p.rapidapi.com/properties/v3/get-photos',[
            'property_id' => $zpid
        ])['data']['home_search']['results'][0]['photos'];

        $images = [];

        foreach ($response as $response) {
            $image = $response['href'];
            $image = str_replace('.jpg', '-w480_h360_x2.webp?w=640&q=75', $image);
            array_push($images,$image);
        }

        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $listing = For_sell::where('property_id','=',$zpid)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('user_dash.buy_details',compact('all','num_investments','account','images','listing','notice'));
    }

    public function more_on_rent($zpid)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
            'X-RapidAPI-Host' => 'realtor.p.rapidapi.com'
        ])->get('https://realtor.p.rapidapi.com/properties/v3/get-photos', [
            'property_id' => $zpid
        ])['data']['home_search']['results'][0]['photos'];

        $images = [];

        foreach ($response as $response) {
            $image = $response['href'];
            $image = str_replace('.jpg', '-w480_h360_x2.webp?w=640&q=75', $image);
            array_push($images, $image);
        }

        $notice = Notification::orderby('created_at')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $listing = For_rent::where('property_id', '=', $zpid)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('user_dash.rent_details', compact('all', 'num_investments', 'account', 'images', 'listing','notice'));
    }


    public function check_buy($id)
    {
        $property = For_sell::where('property_id', '=', $id)->get()->first();
        $balance = Account::where('user_id','=',Auth::user()->id)->get()->first()['balance'];

        if ($property->price/4 <= $balance){
            $account = Account::where('user_id','=',Auth::user()->id)->get()->first();
            $balance = $account->balance;
            $new_bal = $balance - ($property->price/4);
            $account->balance = $new_bal;
            

            $uniq = 'buy-'.Str::random(10);

            $input = [
                'transaction_id' => $uniq,
                'user_id' => Auth::user()->id,
                'property_id' => $property->property_id,
                'paid_id' => $property->id,
                'paid_amount' => $property->price/4,
                'full_amount' => $property->price
            ];

            paid_buy::create($input);
            $account->save();
            return redirect('/dashboard/paid/'.$id);

        }else{
            return redirect()->back()->with('error','You need to have at least one fouth of the price in your open balance.');
        }
    }

    public function paid($id)
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $listing = For_sell::where('property_id', '=', $id)->get()->first();
        $paid = paid_buy::where('property_id','=',$id)->get()->first();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();

        $success = 'Payment has been processed, Contact agent using any channel below.';

        return view('user_dash.paid_comp',compact('paid','all','num_investments','account','success','listing','notice'));
    }

    public function prop_history()
    {
        $notice = Notification::orderby('created_at','DESC')->where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->paginate(5);
        $paid = paid_buy::all();
        $all = Investment::where('user_id', '=', Auth::user()->id)->get()->count();
        $num_investments = Investment::where('user_id', '=', Auth::user()->id)->where('status', '=', 'active')->get()->count();
        $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();

        return view('user_dash.paid', compact('paid', 'all', 'num_investments', 'account','notice'));
    }

    public function check_rent($id)
    {
        $property = For_rent::where('property_id', '=', $id)->get()->first();
        $balance = Account::where('user_id', '=', Auth::user()->id)->get()->first()['balance'];

        if ($property->price <= $balance) {
            $account = Account::where('user_id', '=', Auth::user()->id)->get()->first();
            $balance = $account->balance;
            $new_bal = $balance - ($property->price / 4);
            $account->balance = $new_bal;


            $uniq = 'buy-' . Str::random(10);

            $input = [
                'transaction_id' => $uniq,
                'user_id' => Auth::user()->id,
                'property_id' => $property->property_id,
                'paid_id' => $property->id,
                'paid_amount' => $property->price,
                'full_amount' => $property->price
            ];

            paid_buy::create($input);
            $account->save();
            return redirect('/dashboard/paid/' . $id);
        } else {
            return redirect()->back()->with('error', 'You need to have at least one fouth of the price in your open balance.');
        }
    }


    public function create_investment()
    {
        $options = [
            'simple' => [
                'basic' => [
                    'min' => 1000,
                    'max' => 9999,
                    'percentage' => 12
                ],
                'elite' => [
                    'min' => 10000,
                    'max' => 99999,
                    'percentage' => 11
                ],
                'pro' => [
                    'min' => 100000,
                    'percentage' => 10
                ]
                ],

            'higher' => [
                'basic' => [
                    'min' => 10000,
                    'max' => 99999,
                    'percentage' => 14
                ],
                'elite' => [
                    'min' => 100000,
                    'max' => 999999,
                    'percentage' => 13
                ],
                'pro' => [
                    'min' => 1000000,
                    'percentage' => 11
                ]
            ]
            ];
        

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'X-RapidAPI-Key' => '13cdb17d7amsh8be3afdeb37f0d8p103f42jsn8d229c3734f6',
            'X-RapidAPI-Host' => 'realtor.p.rapidapi.com'
        ])->post('https://realtor.p.rapidapi.com/properties/v3/list', [
            'limit' => 200,
            'offset' => 0,
            'postal_code' => '90045',
            'status' => [
                'for_sale',
                'ready_to_build'
            ],
            'sort' => [
                'direction' => 'desc',
                'field' => 'list_date'
            ]
        ])['data']['home_search']['results'];


        foreach ($response as $key => $value) {
            $selected = array_rand($options);
            if ($key <= 6) {
                if (isset($value['description']['beds'])) {
                    $address = $value['location']['address']['line'];
                    $city = $value['location']['address']['city'];
                    $photo = $value['primary_photo']['href'];
                    $photo = str_replace('.jpg', '-w480_h360_x2.webp?w=640&q=75', $photo);
                    $size = $value['description']['sqft'];
                    $bed = $value['description']['beds'];
                    $address = $address . ', ' . $city;

                    $input = [
                        'plan_id' => 'inv-'. Str::random(10),
                        'basic_min' => $options[$selected]['basic']['min'],
                        'basic_max' => $options[$selected]['basic']['max'],
                        'basic_percent' => $options[$selected]['basic']['percentage'],
                        'elite_min' => $options[$selected]['elite']['min'],
                        'elite_max' => $options[$selected]['elite']['max'],
                        'elite_percent' => $options[$selected]['elite']['percentage'],
                        'pro_min' => $options[$selected]['pro']['min'],
                        'pro_percent' => $options[$selected]['pro']['percentage'],
                        'image' => $photo,
                        'size' => $size,
                        'rooms' => $bed
                    ];

                    Investment_list::create($input);
                }
            }
        }



    }
}
