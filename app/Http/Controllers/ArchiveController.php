<?php

namespace App\Http\Controllers;

use App\Models\Get;
use App\Models\Give;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ArchiveController
 * @package App\Http\Controllers
 */
class ArchiveController extends Controller
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
    public function archievegetindex(Request $request){
        $gets = Get::where('status',3)->orderByDesc('id')->paginate(30);
        return view('archive.getindex',[
            'gets'=>$gets
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function archievegiveindex(Request $request){
        $gives = Give::where('status',3)->orderByDesc('id')->paginate(30);
        return view('archive.giveindex',[
            'gives'=>$gives
        ]);
    }

    public function archievegetview($id){
        $get = Get::select(
            'gets.id',
            'gets.get_time',
            'gets.phone',
            'gets.product_name',
            'gets.lifetime_type',
            'gets.product_lifetime',
            'gets.day',
            'gets.money_type',
            'gets.price',
            'gets.total_price',
            'gets.overpayment',
            'gets.notification',
            'gets.comment',
            'gets.get_name',
            DB::raw('sum(get_money.price) as get_price')
        )->leftJoin('get_money',function ($join){
            $join->on('gets.id','=','get_money.get_id');
        })->groupBy('gets.id')
        ->where('gets.id',$id)
        ->first();
        return view('archive.getview',[
            'get'=>$get
        ]);
    }

    public function archievegiveview($id){
        $give = Give::where('id',$id)->first();
        return view('archive.giveview',[
            'give'=>$give
        ]);
    }
}
