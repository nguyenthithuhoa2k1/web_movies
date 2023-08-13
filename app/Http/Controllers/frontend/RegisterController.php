<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.member.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        DB::beginTransaction();
            try {
                $dataUser = new User;
                $dataUser->name = $request->name;
                $file = $request->image;
                if(!empty($file)){
                    $fileName = $file->getClientOriginalName();
                    $dataUser->image = $fileName;
                    $file->storeAs('public/upload/user_image', $fileName);
                    // Storage::disk('local')->put('public/upload/user_image/'.$fileName, 'Contents');
                }else {
                    $dataUser->image = $request->image_defaulst;
                }
                $dataUser->email = $request->email;
                $dataUser->password = $request->password;
                $dataUser->level = 1;
                $dataUser->save();
                DB::commit();
                return redirect()->route('movies');
            } catch (\Exception $e) {
                // Xử lý ngoại lệ
                Log::error($e);
                DB::rollBack();
                return redirect()->back()->withErrors($e->getMessage());
            }
    }
}
