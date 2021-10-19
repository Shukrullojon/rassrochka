<?php

namespace App\Http\Controllers;

use App\Models\Get;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $archieves = Get::where('status',3)->paginate(1);
        return view('archive.index',[
            'archieves'=>$archieves
        ]);
    }
}
