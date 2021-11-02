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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Give;
use App\Models\GiveMoney;
use App\Models\GiveComment;

/**
 * Class GiveController
 * @package App\Http\Controllers
 */
class GiveController extends Controller
{
    /**
     * GiveController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        $gives = Give::select(
            'gives.id',
            'gives.give_time',
            'gives.phone',
            'gives.product_name',
            'gives.lifetime_type',
            'gives.product_lifetime',
            'gives.day',
            'gives.money_type',
            'gives.price',
            'gives.total_price',
            'gives.overpayment',
            'gives.month_pay',
            'gives.notification',
            'gives.comment',
            'gives.give_name',
            DB::raw('sum(give_money.price) as give_price')
        )->leftJoin('give_money',function ($join){
            $join->on('gives.id','=','give_money.give_id');
        })->groupBy('gives.id')
            ->where('gives.status',1)
            ->where(function ($query) use ($request){
                $query->where('give_name','LIKE',"%".$request->search."%");
            })->orderByDesc('gives.id')
            ->paginate(20);

        return view('give.index',[
            'gives'=>$gives
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('give.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),Give::$createRules);
        if($validator->fails()){
            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $phone = $request->phone;
        $phone = str_replace("+","",$phone);
        $phone = "+".$phone;

        $request->request->add([
            'status'=>1,
            'notification'=>1,
            'give_time' => date("Y-m-d", strtotime($request->give_time)),
            'phone' => $phone,
        ]);

        Give::create($request->all());
        return redirect()->route('giveIndex')->with("success","Saved!");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function archieve($id){
        Give::where('id',$id)->update([
            'status'=>3,
        ]);
        return back()->with('success',"Arxiv yuklandi!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request){
        GiveMoney::create([
            'give_id'=>$request->give_id,
            'price'=>$request->give_price,
            'give_date'=>date("Y-m-d",strtotime($request->give_date)),
            'money_type'=>$request->give_money_type,
        ]);
        return redirect()->route('giveIndex')->with("success","Saved money!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request){
        GiveComment::create([
            'give_id'=>$request->give_id,
            'comment'=>$request->comment,
            'send_date' => date("Y-m-d",strtotime($request->send_date)),
            'price' => $request->price,
            'sms' => $request -> sms,
        ]);
        return redirect()->back()->with("success","Saved comment!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changesms(Request $request){
        $give_id = $request->give_id;
        $give = Give::where('id',$give_id)->first();
        if($give->notification == 1){
            Give::where('id',$give->id)->update([
                'notification' => 0,
            ]);
            return response()->json(0);
        }else{
            Give::where('id',$give->id)->update([
                'notification' => 1,
            ]);
            return response()->json(1);
        }
    }

    /**
     * @param Request $request
     */
    public function givechangephone(Request $request){
        $id = $request -> give_id;
        $give = Give::where('id',$id)->update([
            'phone' => "+".str_replace("+","",$request -> give_phone),
        ]);
        return redirect()->back()->with("success","Nomer o'zgartirildi!");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function givepaymentdelete($id){
        $giveMoney = GiveMoney::where('id',$id)->first();
        if($giveMoney){
            $giveMoney->delete();
        }
        return redirect()->back()->with("success","To'lov o'chirildi!");
    }
}
