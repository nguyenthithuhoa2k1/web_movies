<?php

namespace App\Http\Controllers\admin;

use App\Models\Country;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
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
        return view('admin.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.add_country');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        DB::beginTransaction();
        try {
            $country = new Country;
            $country->country = $request->country;
            $country->save();
            DB::commit();
            return redirect()->route('countries.index')->with('success','Add success');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Add error.'.$e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataCountry = Country::where('id',$id)->get();
        return view('admin.countries.edit_country',compact('dataCountry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $country = Country::lockForUpdate()->find($id);
            if($country){
                $currentVersion = $country->version;
                $data['country'] = $request->country;

                if($currentVersion == $request->version){
                    $data['version'] = $currentVersion + 1;
                    $country->update($data);
                    DB::commit();
                    return redirect()->route('countries.index')->with('success','Update success');
                }else{
                    DB::rollBack();
                    return redirect()->back()->withErrors('The data has been updated by another user.');
                }
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors('Update error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Country::where('id',$id)->delete();
            DB::commit();
            return redirect()->route('countries.index')->with('success','Delete success');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ
            Log::error($e);
            DB::rollBack();
            return redirect()->back()->withErrors('Delete error');
        }
    }
}
