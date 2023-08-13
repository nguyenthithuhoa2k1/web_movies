<?php

namespace App\Http\Controllers\admin;

use App\Models\Genres;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenresRequest;

class GenresController extends Controller
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
        return view('admin.genres.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.genres.add_genres');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenresRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataGenres = new Genres;
            $dataGenres->genres = $request->genres;
            $dataGenres->save();
            DB::commit();
            return redirect()->route('genres.index')->with('success','Add success');
        }catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Add error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataGenres = Genres::where('id',$id)->get();
        return view('admin.genres.edit_genres',compact('dataGenres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenresRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = [];
            $dataGenres = Genres::lockForUpdate()->find($id);
            if($dataGenres){
                $data['genres'] = $request->genres;
                $currentVersion = $dataGenres->version;
                if($currentVersion == $request->version){
                    $data['version'] = $currentVersion + 1;
                    $dataGenres->update($data);
                    DB::commit();
                    return redirect()->route('genres.index')->with('success','Update success');
                }else {
                    DB::rollBack();
                    return redirect()->back()->withErrors('The data has been updated by another user.');
                }
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Update error'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Genres::where('id',$id)->delete();
            DB::commit();
            return redirect()->back()->with('success','Delete success');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors('Delete error');
        }
    }
}
