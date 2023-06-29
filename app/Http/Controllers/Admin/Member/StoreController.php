<?php

namespace App\Http\Controllers\Admin\Member;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function store(Request $request){
        if ($request->action == 'create'){
            
            $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Failed');
            }

            DB::beginTransaction();
            try {
                
                $image = $request->file('photo');
                $image->storeAs('public/member', $image->hashName());

                $data = Member::create([
                    'photo'     => $image->hashName(),
                    'name'     => $request->name,
                    'username'   => $request->username,
                    'password'=>Hash::make($request->password),
                ]);
    
            } catch (\Throwable $th) {
                Log::info('Failed created book = '.$th);
                DB::rollback();
                return redirect()->back()->with('error', 'Failed '.$th);
            }
                DB::commit();
                return redirect()->route('admin-member-index')->with('success','Member Successfully Created');
            }

        return view('pages/admin/member/create');
    }
}
