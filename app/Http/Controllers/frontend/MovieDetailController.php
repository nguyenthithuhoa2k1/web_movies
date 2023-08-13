<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $dataMovie = Movie::where('id',$id)->get();
        return view('frontend.home.movie-detail',compact('dataMovie'));
    }
}
