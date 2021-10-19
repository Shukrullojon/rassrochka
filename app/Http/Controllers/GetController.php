<?php
/*
 * MyOwnProject Copyright (c)  2021.
 *
 * Created by Fatulloyev Shukrullo
 * Please contact before making any changes
 *
 * Tashkent, Uzbekistan
 */
namespace App\Http\Controllers;

use App\Models\Get;
use App\Models\GetMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class GetController
 * @package App\Http\Controllers
 */
class GetController extends Controller
{
    /**
     * GetController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        $gets = Get::select(
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
          ->where('gets.status',1)
          ->where(function ($query) use ($request){
              $query->where('get_name','LIKE',"%".$request->search."%");
          })->orderByDesc('gets.id')
          ->paginate(20);
        return view('get.index',[
            'gets'=>$gets
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('get.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        //dd($request);
        $validator = Validator::make($request->all(),Get::$createRules);

        if($validator->fails()){
            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $request->request->add([
            'status'=>1,
            'notification'=>1,
            'get_time' => date('Y-m-d H:i:s'),
        ]);
        Get::create($request->all());
        return redirect()->route('getIndex')->with("success","Saved!");
    }

    public function archieve($id){
        Get::where('id',$id)->update([
            'status'=>3,
        ]);
        return back()->with('success',"Arxiv yuklandi!");
    }

    public function payment(Request $request){
        GetMoney::create([
            'get_id'=>$request->get_id,
            'price'=>$request->get_price,
            'get_date'=>date("Y-m-d"),
            'money_type'=>$request->get_money_type,
        ]);
        return redirect()->route('getIndex')->with("success","Saved money!");
    }

    public function changesms(Request $request){
        $get_id = $request->get_id;
        $get = Get::where('id',$get_id)->first();
        if($get->notification == 1){
            Get::where('id',$get->id)->update([
                'notification' => 0,
            ]);
            return response()->json(0);
        }else{
            Get::where('id',$get->id)->update([
                'notification' => 1,
            ]);
            return response()->json(1);
        }
    }
}
