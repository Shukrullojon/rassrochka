<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
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
        $users = User::orderByDesc('id')->get();
        return view('user.index',[
            'users' => $users,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('user.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'password' => 'min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        if($validator->fails()){
            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $request->phone = "+".str_replace("+","",$request->phone);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
            'phone' => $request->phone,
            'sms' => $request->sms,
        ]);
        return redirect()->route('userIndex')->with("success","Saved!");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        $user = User::where('id',$id)->first();
        if($user and $user->id != Auth::user()->id)
            $user->delete();
        return redirect()->route('userIndex')->with("success","User delete!");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){
        $user = User::where('id',$id)->first();
        return view('user.edit',[
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'confirm_password' => 'required_with:password|same:password',
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if($validator->fails()){
            if($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }
        $user = User::where('id',$request->id)->first();
        $request->phone = "+".str_replace("+","",$request->phone);
        $pass = $user->password;
        if($request->password){
            $pass = Hash::make($request->password);
        }
        $update = User::where('id',$user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sms' => $request -> sms,
            'password' => $pass,
        ]);
        return redirect()->route('userIndex')->with("success","Ma'lumot o'zgartirildi!");
    }
}
