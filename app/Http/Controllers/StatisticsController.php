<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Get;
use App\Models\Give;
use Illuminate\Support\Facades\DB;

/**
 * Class StatisticsController
 * @package App\Http\Controllers
 */
class StatisticsController extends Controller
{
    /**
     * ArchiveController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        // 1

        $priceD = Get::select(
            DB::raw('sum(price) as price'),
            DB::raw('sum(total_price) as total_price'),
        )->where('status',1)->where('money_type',1)->first();

        $priceS = Get::select(
            DB::raw('sum(price) as price'),
            DB::raw('sum(total_price) as total_price'),
        )->where('status',1)->where('money_type',2)->first();


        $arxiv_d = Get::select(
            DB::raw('sum(total_price - price) as useful_price')
        )->where('status',3)->where('money_type',1)->first();
        $arxiv_s = Get::select(
            DB::raw('sum(total_price - price) as useful_price')
        )->where('status',3)->where('money_type',2)->first();

        $getOstatkaD = Get::select(
            'total_price',
            'overpayment',
            DB::raw('sum(get_money.price) as get_price'),
        )->leftJoin('get_money',function ($join){
            $join->on('gets.id','=','get_money.get_id');
        })->groupBy('gets.id')
        ->where('gets.status',1)
        ->where('gets.money_type',1)
        ->get();

        $getOstatkaS = Get::select(
            'total_price',
            'overpayment',
            DB::raw('sum(get_money.price) as get_price'),
        )->leftJoin('get_money',function ($join){
            $join->on('gets.id','=','get_money.get_id');
        })->groupBy('gets.id')
            ->where('gets.status',1)
            ->where('gets.money_type',2)
            ->get();

        $giveOstatkaD = Give::select(
            'total_price',
            'overpayment',
            DB::raw('sum(give_money.price) as give_price'),
        )->leftJoin('give_money',function ($join){
            $join->on('gives.id','=','give_money.give_id');
        })->groupBy('gives.id')
            ->where('gives.status',1)
            ->where('gives.money_type',1)
            ->get();

        $giveOstatkaS = Give::select(
            'total_price',
            'overpayment',
            DB::raw('sum(give_money.price) as give_price'),
        )->leftJoin('give_money',function ($join){
            $join->on('gives.id','=','give_money.give_id');
        })->groupBy('gives.id')
            ->where('gives.status',1)
            ->where('gives.money_type',2)
            ->get();

        $getOsD = 0;
        foreach($getOstatkaD as $gd){
            $s = $gd->total_price - ($gd->overpayment + $gd->get_price);
            $getOsD = $getOsD + $s;
        }
        $getOsS = 0;
        foreach($getOstatkaS as $gs){
            $s = $gs->total_price - ($gs->overpayment + $gs->get_price);
            $getOsS = $getOsS + $s;
        }

        $giveOsD = 0;
        foreach($giveOstatkaD as $gd){
            $s = $gd->total_price - ($gd->overpayment + $gd->give_price);
            $giveOsD = $giveOsD + $s;
        }

        $giveOsS = 0;
        foreach($giveOstatkaS as $gs){
            $s = $gs->total_price - ($gs->overpayment + $gs->give_price);
            $giveOsS = $giveOsS + $s;
        }

        return view('statistics.index',[
            'priceD' => $priceD,
            'priceS' => $priceS,
            'arxiv_d' => $arxiv_d,
            'arxiv_s' => $arxiv_s,
            'getOsD' => $getOsD,
            'getOsS' => $getOsS,
            'giveOsD' => $giveOsD,
            'giveOsS' => $giveOsS,
        ]);
    }
}
