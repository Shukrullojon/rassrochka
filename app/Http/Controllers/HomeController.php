<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Get;
use App\Models\Give;
use App\Models\GetMoney;
use App\Models\GetComment;
use App\Models\GiveComment;
use App\Models\GiveMoney;
use App\Services\Eskiz;
use Illuminate\Support\Facades\DB;

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

        $today = date("Y-m-d");
        $today_month_get = Get::select(
            'gets.id',
            'gets.product_name',
            'gets.money_type',
            'gets.price',
            'gets.total_price',
            'gets.overpayment',
            'gets.get_name',
            'gets.month_pay',
            DB::raw('sum(get_money.price) as get_price')
        )->leftJoin('get_money',function ($join){
            $join->on('gets.id','=','get_money.get_id');
        })->groupBy('gets.id')
            ->where('gets.status',1)
            ->where('lifetime_type',1)
            ->where('day',date('d'))
            ->orderByDesc('gets.id')
            ->get();

        //$today_month_get = Get::where('status',1)->where('lifetime_type',1)->where('day',date('d'))->get();
        $today_week_get = Get::select(
            'gets.id',
            'gets.product_name',
            'gets.money_type',
            'gets.price',
            'gets.total_price',
            'gets.overpayment',
            'gets.get_name',
            'gets.month_pay',
            DB::raw('sum(get_money.price) as get_price')
        )->leftJoin('get_money',function ($join){
            $join->on('gets.id','=','get_money.get_id');
        })->groupBy('gets.id')
            ->orderByDesc('gets.id')
            ->where('status',1)
            ->where('lifetime_type',2)
            ->where('day',$day_number)
            ->get();


        $today_month_give = Give::select(
            'gives.id',
            'gives.product_name',
            'gives.money_type',
            'gives.price',
            'gives.total_price',
            'gives.overpayment',
            'gives.give_name',
            'gives.month_pay',
            DB::raw('sum(give_money.price) as give_price')
        )->leftJoin('give_money',function ($join){
            $join->on('gives.id','=','give_money.give_id');
        })->groupBy('gives.id')
            ->where('status',1)
            ->where('lifetime_type',1)
            ->where('day',date('d'))
            ->orderByDesc('gives.id')
            ->get();

        $today_week_give = Give::select(
            'gives.id',
            'gives.product_name',
            'gives.money_type',
            'gives.price',
            'gives.total_price',
            'gives.overpayment',
            'gives.give_name',
            'gives.month_pay',
            DB::raw('sum(give_money.price) as give_price')
        )->leftJoin('give_money',function ($join){
            $join->on('gives.id','=','give_money.give_id');
        })->groupBy('gives.id')
            ->where('status',1)
            ->where('lifetime_type',2)
            ->where('day',$day_number)
            ->orderByDesc('gives.id')
            ->get();

        $getComment = GetComment::where('send_date',date("Y-m-d"))->get();
        $giveComment = GiveComment::where('send_date',date("Y-m-d"))->get();

        return view('home.index',[
            'today_month_get'=>$today_month_get,
            'today_week_get'=>$today_week_get,
            'today_month_give'=>$today_month_give,
            'today_week_give'=>$today_week_give,
            'getComment' => $getComment,
            'giveComment' => $giveComment,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request){
        if($request->has("get_id")){
            GetMoney::create([
                'get_id'=>$request->get_id,
                'price'=>$request->get_price,
                'get_date'=>date("Y-m-d",strtotime($request->get_date)),
                'money_type'=>$request->get_money_type,
            ]);
        }

        if($request->has("give_id")){
            GiveMoney::create([
                'give_id'=>$request->give_id,
                'price'=>$request->give_price,
                'give_date'=>date("Y-m-d",strtotime($request->give_date)),
                'money_type'=>$request->give_money_type,
            ]);
        }
        return redirect()->route('home')->with("success","Saved money!");
    }
}
