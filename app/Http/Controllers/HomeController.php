<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Get;
use App\Models\Give;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $arrayDay = [
            "Mon"=>'1',
            "Tue"=>'2',
            "Wed"=>'3',
            "Thu"=>'4',
            "Fri"=>'5',
            "Sat"=>'6',
            "Sun"=>'7',
        ];
        $day_number = $arrayDay[date("D")];

        $today_month_get = Get::where('status',1)->where('lifetime_type',1)->where('day',date('d'))->get();
        $today_week_get = Get::where('status',1)->where('lifetime_type',2)->where('day',$day_number)->get();

        $today_month_give = Give::where('status',1)->where('lifetime_type',1)->where('day',date('d'))->get();
        $today_week_give = Give::where('status',1)->where('lifetime_type',2)->where('day',$day_number)->get();

        return view('home.index',[
            'today_month_get'=>$today_month_get,
            'today_week_get'=>$today_week_get,
            'today_month_give'=>$today_month_give,
            'today_week_give'=>$today_week_give,
        ]);
    }
}
