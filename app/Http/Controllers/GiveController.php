<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiveController extends Controller
{
    public function index(){
        return view('give.index');
    }
}
