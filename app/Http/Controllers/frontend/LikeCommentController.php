<?php

namespace App\Http\Controllers\frontend;

use App\Models\LikeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
    /**
     *check login
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * insert like
     */
    public function like(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::id();
            DB::beginTransaction();
            try {
                $flag = true;
                $commentLiked = LikeComment::where('comment_id', $request->comment_id)->where('user_id', $user_id)->first();
                if(empty($commentLiked)){
                    $likeComment = new LikeComment;
                    $likeComment->like = 1;
                    $likeComment->dislike = 0;
                    $likeComment->comment_id = $request->comment_id;
                    $likeComment->user_id = $user_id;
                    $likeComment->save();
                }else{
                    if($commentLiked['like'] == 1){
                        $commentLiked->delete();
                        $flag = false;
                    }
                    if($commentLiked['dislike'] == 1){
                        $commentLiked->like = 1;
                        $commentLiked->dislike = 0;
                        $commentLiked->save();
                    }
                }
                DB::commit();
                return response()->json(['success' => 'like succes','flag' => $flag]);
            } catch(\Exception $e){
                Log::error($e);
                DB::rollBack();
                return response()->json([$e->getMessage()]);
            }
        }else{
            return view('frontend.member.login');
        }
    }

    /**
     * insert dislike
     */
    public function dislike(Request $request)
    {
        $user_id = Auth::id();
        DB::beginTransaction();
        try {
            $flag = true;
            $commentLiked = LikeComment::where('comment_id', $request->comment_id)->where('user_id', $user_id)->first();
            if(empty($commentLiked)){
                $likeComment = new LikeComment;
                $likeComment->like = 0;
                $likeComment->dislike = 1;
                $likeComment->comment_id = $request->comment_id;
                $likeComment->user_id = $user_id;
                $likeComment->save();
            }else{
                if($commentLiked['dislike'] == 1){
                    $commentLiked->delete();
                    $flag = false;
                }
                if($commentLiked['dislike'] == 0){
                    $commentLiked->like = 0;
                    $commentLiked->dislike = 1;
                    $commentLiked->save();
                }
            }
            DB::commit();
            return response()->json(['success' => 'like succes','flag' => $flag]);
        } catch(\Exception $e){
            Log::error($e);
            DB::rollBack();
            return response()->json([$e->getMessage()]);
        }
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
