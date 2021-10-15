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
use Illuminate\Http\Request;
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
    public function index(){
        $gets = Get::where('status',1)->orderByDesc('id')->get();
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
        $validator = Validator::make(Get::$createRules);
        if($validator->fails()){
            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
    }


}