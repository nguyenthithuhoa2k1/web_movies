<?php

namespace App\Http\Controllers\frontend;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * check login
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * insert comment
     */
    public function commentParent(Request $request)
    {
        $dataUser = Auth::user();
        $user_id = Auth::id();
        DB::beginTransaction();
        try {
            $dataComment = new Comment;
            $dataComment->comment = $request->comment;
            $dataComment->movie_id = $request->movie_id;
            $dataComment->user_id = $user_id;
            $dataComment->level = 0;
            $dataComment->save();
            DB::commit();
            return response()->json(['message' => 'Sucess','dataComment' => $dataComment,'dataUser'=>$dataUser]);
        } catch (\Exception $e){
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * insert comment reply.
     */
    public function commentReply(Request $request)
    {
        $dataUser = Auth::user();
        $user_id = Auth::id();
        DB::beginTransaction();
        try {
            $dataCommentReply = new Comment;
            $dataCommentReply->comment = $request->comment;
            $dataCommentReply->movie_id = $request->movie_id;
            $dataCommentReply->user_id = $user_id;
            $dataCommentReply->level = $request->commentParentId;
            $dataCommentReply->save();
            DB::commit();
            return response()->json(['message' => 'Sucess','dataCommentReply' => $dataCommentReply,'dataUser'=>$dataUser]);
        } catch (\Exception $e){
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
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
