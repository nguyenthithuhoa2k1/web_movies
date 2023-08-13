<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.member.login');
    }

    /**
     * login.
     */
    public function login(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            $login = [
                'email'=>$request->email,
                'password'=>$request->password,
                'level'=>1,
            ];
            $remember=false;
            if($request->remember_me){
                $remember=true;
            }
            $this->middleware('member');
            Auth::attempt($login,$remember);
            DB::commit();
            return redirect()->route('movies')->with('success','login success.');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * logout.
     */
    public function logout()
    {
            Auth::logout();
            return redirect()->route('memberLogin');
    }
}
