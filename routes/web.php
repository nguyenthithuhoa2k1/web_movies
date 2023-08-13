<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\GenresController;
use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\RegisterController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\MovieDetailController;
use App\Http\Controllers\frontend\CommentController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\CommentChildController;
use App\Http\Controllers\frontend\LikeCommentController;
use App\Http\Controllers\frontend\RateController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group([
    'prefix' => 'admin', # tiền tố trước url. ví dụ: /admin/home or /admin/profile
    'middleware' => ['admin']],function(){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        //profile
        Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'index']);
        //movies
        Route::resource('movies', MovieController::class);
        //country
        Route::resource('countries', CountryController::class);
        //genres
        Route::resource('genres', GenresController::class);
        //categories
        Route::resource('categories',CategoryController::class);
        Route::get('/category/detail/{id}', [App\Http\Controllers\admin\CategoryController::class, 'showDetail']);
        Route::post('/category/detail/{id}', [App\Http\Controllers\admin\CategoryController::class, 'addDetail']);
        //episodes
        Route::get('/episodes/{id}', [App\Http\Controllers\admin\EpisodeController::class, 'index'])->name('episodes');
        Route::get('/episodes/{id}/add', [App\Http\Controllers\admin\EpisodeController::class, 'create']);
        Route::post('/episodes/{id}/add', [App\Http\Controllers\admin\EpisodeController::class, 'store']);
        Route::get('/episodes/{id}/edit', [App\Http\Controllers\admin\EpisodeController::class, 'edit']);
        Route::post('/episodes/{id}/edit', [App\Http\Controllers\admin\EpisodeController::class, 'update']);
        Route::delete('/episodes/{id}', [App\Http\Controllers\admin\EpisodeController::class, 'destroy']);
});
//login
Route::get('member/login',[App\Http\Controllers\frontend\LoginController::class,'index'])->name('memberLogin');
Route::post('member/login',[App\Http\Controllers\frontend\LoginController::class,'login']);
//register
Route::get('member/register',[App\Http\Controllers\frontend\RegisterController::class,'index']);
Route::post('member/register',[App\Http\Controllers\frontend\RegisterController::class,'store']);

//logout
Route::get('member/logout',[App\Http\Controllers\frontend\LoginController::class,'logout']);
Route::group([
    'namespace' => 'frontend',
    'middleware' => ['member']],function(){
        //movie
        Route::get('/movies',[App\Http\Controllers\frontend\FrontendController::class,'index'])->name('movies');
        //movie detail
        Route::get('/movie/detail/{id}',[App\Http\Controllers\frontend\MovieDetailController::class,'index'])->name('movieDetail');
        //comment
        Route::post('/movie/comment',[App\Http\Controllers\frontend\CommentController::class,'commentParent']);
        Route::post('/movie/comment/reply',[App\Http\Controllers\frontend\CommentController::class,'commentReply']);
        //watch
        Route::get('/watch/{id}',[App\Http\Controllers\frontend\WatchController::class,'index']);
        //search
        Route::get('/search',[App\Http\Controllers\frontend\SearchController::class,'search'])->name('search');
        Route::get('/search/category/{id}',[App\Http\Controllers\frontend\SearchController::class,'searchCategory']);
        Route::get('/search/movies/news',[App\Http\Controllers\frontend\SearchController::class,'searchMoviesNew']);
        Route::get('/search/country/{id}',[App\Http\Controllers\frontend\SearchController::class,'searchCountry']);
        Route::get('/search/movies/genres/{id}',[App\Http\Controllers\frontend\SearchController::class,'searchMoviesGenres']);
        //like
        Route::post('/movie/like',[App\Http\Controllers\frontend\LikeCommentController::class,'like']);
        Route::post('/movie/dislike',[App\Http\Controllers\frontend\LikeCommentController::class,'dislike']);
        //rate
        Route::post('/movie/rate',[App\Http\Controllers\frontend\RateController::class,'rate']);
});
