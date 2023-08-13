<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episode;

class WatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $movie_id = Episode::where('id',$id)->pluck('movie_id');
        $dataEpisodes = Episode::where([
            'movie_id' => $movie_id,
            'id' => $id,
        ])->get();
        $dataAllEpisodes = Episode::where('movie_id',$movie_id)->get();
        return view('frontend.home.watch',compact('dataAllEpisodes','dataEpisodes'));
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
    public function show()
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
