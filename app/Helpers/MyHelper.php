<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genres;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Comment;
use App\Models\User;
use App\Models\LikeComment;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MyHelper
{
    /**
     * Get data Category
     */
    public static function getAllCategories()
    {
        $dataCategory = Category::where('level',0)->paginate(20);
        return $dataCategory;
    }

    /**
     * Get data Country
     */
    public static function getAllCountries()
    {
        $dataCountry = Country::paginate(7);
        return $dataCountry;
    }

    /**
     * Get data Genres
     */
    public static function getAllGenres()
    {
        $dataGenres = Genres::paginate(20);
        return $dataGenres;
    }

    /**
     * Get data movies
     */
    public static function getMovies() {
        $movies = Movie::leftJoin('countries', 'movies.country_id', '=', 'countries.id')
                         ->leftJoin('genres', 'movies.genres_id', '=', 'genres.id')
                         ->leftJoin('categories', 'movies.category_id', '=', 'categories.id')
                         ->get(['movies.*','countries.country','genres.genres','categories.category']);
        return $movies;
    }

    /**
     * Get all data movies
     */
    public static function getAllMovies() {
        $dataMovie = Movie::paginate(20);
        return $dataMovie;
    }

    /**
     * Get all data movies and episodes
     */
    public static function getAllEpisodesMovies($movie_id) {
        $dataEpisode = Episode::leftJoin('movies', 'episodes.movie_id', '=', 'movies.id')->where('movie_id',$movie_id)->orderBY('id')
                                ->get(['episodes.id','episodes.movie_id','episodes.links','episodes.episodes','movies.title','movies.image']);

        return $dataEpisode;
    }

    /**
     * Get all data firsf episodes
     */
    public static function getFirsfEpisodes($movie_id) {
        $dataFirstEpisode = Episode::where('movie_id',$movie_id)->first();
        return $dataFirstEpisode;
    }

    /**
     * Get all data comment parent.
     */
    public static function getDataCommentParent($movie_id){
        $dataCommentParent = Comment::leftJoin('users','comments.user_id','=','users.id')
                                        ->where('comments.level',0)
                                        ->where('comments.movie_id',$movie_id)
                                        ->orderBY('comments.id','desc')
                                        ->paginate(3,['comments.id','comments.comment','comments.created_at','users.name','users.image']);
        return $dataCommentParent;
    }
    /**
     * Get all data comment reply.
     */
    public static function getDataCommentReply($movie_id,$level){
        $dataCommentReply = Comment::leftJoin('users','comments.user_id','=','users.id')
                                        ->where('comments.level',$level)
                                        ->where('comments.movie_id',$movie_id)
                                        ->orderBY('comments.id','desc')
                                        ->paginate(3,['comments.id','comments.comment','comments.created_at','users.name','users.image']);
        return $dataCommentReply;
    }

    /**
     * Get all data like comment.
     */
    public static function getLikeComment($comment_id, $user_id){
        $dataLikeComment = LikeComment::where('comment_id', $comment_id)->where('user_id', $user_id)->first();
        return $dataLikeComment;
    }

    /**
     * Get all data sum like comment.
     */
    public static function getSumLikeComment($comment_id){
        $sumLike = LikeComment::where('comment_id', $comment_id)->sum('like');
        return $sumLike;
    }

    /**
     * Get all data sum dislike comment.
     */
    public static function getSumDislikeComment($comment_id){
        $sumDislike = LikeComment::where('comment_id', $comment_id)->sum('dislike');
        return $sumDislike;
    }
    /**
     * Get all data like comment reply.
     */
    public static function getLikeCommentReply($comment_id, $user_id){
        $dataLikeComment = LikeComment::where('comment_id', $comment_id)->where('user_id', $user_id)->first();
        return $dataLikeComment;
    }

    /**
     * Get all data sum like comment reply.
     */
    public static function getSumLikeCommentReply($comment_id){
        $sumLike = LikeComment::where('comment_id', $comment_id)->sum('like');
        return $sumLike;
    }

    /**
     * Get all data sum dislike comment reply.
     */
    public static function getSumDislikeCommentReply($comment_id){
        $sumDislike = LikeComment::where('comment_id', $comment_id)->sum('dislike');
        return $sumDislike;
    }

    /**
     * Get all data rate.
     */
    public static function getRate($movie_id){
        $getrateAverage = Rate::where('movie_id',$movie_id)->pluck('rate')->avg();
        $rateAverage = number_format($getrateAverage, 2);
        return $rateAverage;
    }
    /**
     * Get data movies favourite.
     */
    public static function getMoviesfavourite(){
        $averageRates = Rate::join('movies', 'rate.movie_id', '=', 'movies.id')
                            ->groupBy('rate.movie_id', 'movies.id', 'movies.image', 'movies.title')
                            ->selectRaw('AVG(rate.rate) as average_rate, movies.id, movies.image, movies.title')
                            ->orderBy('average_rate','desc')
                            ->limit(5)
                            ->get();
        return $averageRates;

    }
    /**
     * Get data movies new.
     */
    public static function getMoviesNew(){
        $getMoviesNew = Movie::where('year','>',now()->year)->get();
        return $getMoviesNew;

    }
    /**
     * Get data suggest movies.
     */
    public static function getMoviesSuggest(){
        $getMoviesSuggest = Movie::all()->random(5);
        return $getMoviesSuggest;

    }
}
