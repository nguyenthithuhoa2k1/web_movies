<?php

namespace App\Http\Controllers\frontend;

use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * check login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * insert rate.
     */
    public function rate(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::id();
            $movie_id = $request->movie_id;
            $rate = $request->rate;
            DB::beginTransaction();
            try {
                $getRate = Rate::where('user_id',$user_id)->where('movie_id',$movie_id)->first();
                if(empty($getRate)){
                    $dataRate = new Rate;
                    $dataRate->rate = $rate;
                    $dataRate->user_id = $user_id;
                    $dataRate->movie_id = $movie_id;
                    $dataRate->save();
                }else {
                    $getRate->rate = $rate;
                    $getRate->save();
                }
                DB::commit();
                $rateAverage = Rate::where('movie_id',$movie_id)->pluck('rate')->avg();
                return response()->json(['success'=>'cảm ơn bạn đã đánh giá','rateAverage'=>$rateAverage]);
            } catch(\Exception $e){
                Log::error($e);
                DB::rollBack();
                return response()->json(['errors'=>'rate errors.'.$e->getMessage()]);
            }
        }else{
            return view('frontend.member.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
