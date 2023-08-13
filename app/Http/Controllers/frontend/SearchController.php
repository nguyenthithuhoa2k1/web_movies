<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genres;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * search title.
     */
    public function search(Request $request)
    {
        $dataMovies="";
        // Check if the 'search' parameter exists in the request
        if (isset($request->search)) {
            // Get the search query from the 'search' parameter
            $searchQuery = $request->search;

            // Use the search query to filter movies that match the title
            $dataMovies = Movie::where('title','like',"%{$searchQuery}%")->orderBy('id')->get();
            return view('frontend.home.search', compact('dataMovies'));
        } else {
            // If 'search' parameter is not present, show all movies
            return redirect()->route('movies');
        }
    }

    /**
     * search categories.
     */
    public function searchCategory(string $id)
    {
        $dataMovies = Movie::where('category_id',$id)->get();
        return view('frontend.home.search', compact('dataMovies'));
    }

    /**
     * search movies new.
     */
    public function searchMoviesNew()
    {
        $dataMovies = Movie::where('year',now()->year)->get();
        return view('frontend.home.search', compact('dataMovies'));
    }

    /**
     * search countries.
     */
    public function searchCountry(string $id)
    {
        $dataMovies = Movie::where('country_id',$id)->get();
        return view('frontend.home.search', compact('dataMovies'));
    }

    /**
     * search genres.
     */
    public function searchMoviesGenres(string $id)
    {
        $dataMovies = Movie::where('genres_id',$id)->get();
        return view('frontend.home.search', compact('dataMovies'));
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
