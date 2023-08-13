<?php

namespace App\Http\Controllers\admin;

use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\EpisodeRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        return view('admin.episodes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('admin.episodes.add-episode');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EpisodeRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $dataEpisodes = new Episode;
            $dataEpisodes->links = $request->links;
            $dataEpisodes->episodes = $request->episodes;
            $dataEpisodes->movie_id = $id;
            $dataEpisodes->save();
            DB::commit();
            return redirect()->route('episodes', $id)->with('success','Add success');
        }catch(\Exception $e) {
            Log::error($e);
            DB::rollBAck();
            return redirect()->back()->withInput()->withErrors('Add error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataEpisodes = Episode::where('id',$id)->get();
        return view('admin.episodes.edit-episode',compact('dataEpisodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EpisodeRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $episodes = Episode::lockForUpdate()->find($id);
            if($episodes){
                $data['episodes'] = $request->episodes;
                $data['links'] = $request->links;
                $currentVersion = $episodes->version;
                if($currentVersion == $request->version){
                    $data['version'] = $currentVersion + 1;
                    $episodes->update($data);
                    DB::commit();
                    return redirect()->route('movies.index')->with('success','Edit success');
                }else{
                    DB::rollBack();
                    return redirect()->back()->withErrors('The data has been updated by another user.');
                }
           }
        } catch(\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Edit error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Episode::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('episodes', $id)->with('success','Delete success');
        } catch(\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors('Delete error');
        }
    }
}
