<?php

namespace App\Http\Controllers\admin;

use App\Models\Movie;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * check login
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.movies.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.movies.add_movie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::id();
            $movies = new Movie;
            $file = $request->image;
            if(!empty($file)){
                $fileName = $file->getClientOriginalName();
                $movies->image = $fileName;
                $file->storeAs('upload/movies_image', $fileName,'public');
                // Storage::disk('local')->put('upload/movies_image/'.$fileName, 'Contents');
                Storage::setVisibility(' $fileName', 'private');
            }
            $movies->title = $request->title;
            $movies->descriptions = $request->descriptions;
            $movies->status = $request->status;
            $movies->country_id = $request->country_id;
            $movies->category_id = $request->category_id;
            $movies->perfomer = $request->perfomer;
            $movies->genres_id = $request->genres_id;
            $movies->year = $request->year;
            $movies->user_id = $user_id;
            $movies->save();
            DB::commit();
            return redirect()->route('movies.index')->with('success','Add success');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            //lưu log
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataMovie = Movie::where('id',$id)->get();
        return view('admin.movies.edit_movie',compact('dataMovie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::id();
            $data = [];
            $movie =Movie::find($id);
            if($movie){
                $file = $request->image;
                if(!empty($file)){
                    $fileName = $file->getClientOriginalName();
                    $data['image'] = $fileName;
                    $file->storeAs('upload/movies_image', $fileName);
                    // Storage::disk('local')->put('upload/movies_image/'.$fileName, 'Contents');
                }else{
                    $data['image'] = $movie->image;
                }
                $data['title']= $request->title;
                $data['descriptions']= $request->descriptions;
                $data['status']= $request->status;
                $data['country_id']= $request->country_id;
                $data['category_id']= $request->category_id;
                $data['perfomer']= $request->perfomer;
                $data['genres_id']= $request->genres_id;
                $data['year']= $request->year;
                $data['user_id']= $user_id;
                $currentVersion = $movie->version;
                if($currentVersion == $request->version){
                    $data['version']= $currentVersion + 1;
                    $movie->update($data);
                    DB::commit();
                    return redirect()->route('movies.index')->with('success','Update success');
                }else {
                    DB::rollBack();
                    return redirect()->back()->withErrors('The data has been updated by another user.');
                }
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Update error' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Movie::where('id',$id)->delete();
            DB::commit();
            return redirect()->back()->with('success','Delete success.');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors('Delete error');
        }
    }

}
