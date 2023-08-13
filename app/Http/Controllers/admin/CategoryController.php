<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Version;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataCategory = new Category;
            $dataCategory->category = $request->category;
            $dataCategory->level = 0;
            $dataCategory->save();
            DB::commit();
            return redirect()->route('categories.index')->with('success','Add success');
        } catch (\Exception $e) {
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
        $dataCategory = Category::where('id',$id)->get();
        return view('admin.categories.edit_category',compact('dataCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $record = Category::find($id);

            if ($record) {
                $currentVersion = $record->version;
                $newData['category'] = $request->category;

                // Kiểm tra xem phiên làm việc thứ hai có còn dựa trên phiên bản của phiên làm việc đầu tiên hay không
                if ($currentVersion == $request->version) {
                    // Cập nhật dữ liệu và tăng version
                    $newData['version'] = $currentVersion + 1;
                    $record->update($newData);

                    DB::commit();
                    return redirect()->route('categories.index')->with('success', 'Update success');
                } else {
                    DB::rollBack();
                    return redirect()->back()->withErrors('The data has been updated by another user.');
                }
            }

        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Category::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('categories.index')->with('success','Delete success');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors('Delete error');
        }
    }

    /**
     * Show resource details list.
     */
    public function showDetail(string $id)
    {
        return view('admin.categories.category_detail');
    }
    public function addDetail(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $dataCategoryDetail = new Category;
            $dataCategoryDetail->category = $request->category;
            $dataCategoryDetail->level = $id;
            $dataCategoryDetail->save();
            DB::commit();
            return redirect()->route('categories.index')->with('success','Add success');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Add error');
        }
    }
}
