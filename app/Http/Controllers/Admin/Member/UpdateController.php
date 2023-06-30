<?php

namespace App\Http\Controllers\Admin\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function update(Request $request, $id){
        $data = Member::where('id', $id)->first();
        
        if ($request->action == 'update'){
            
            $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            ]);

            if ($request->file('photo')) {
                $request->validate([
                    'photo' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
                ]);
            }

            DB::beginTransaction();
            try {
                
                if ($request->hasFile('photo')) {

                    //upload image
                    $image = $request->file('photo');
                    $image->storeAs('public/member', $image->hashName());
        
                    //delete old image
                    Storage::delete('public/member/' . $image);
        
                    //update member with new image
                    $member = Member::where('id', $id)->first();
                    if ($member) {
        
                        $member->photo = $image->hashName();
                        $member->name   = $request->name;
                        $member->username   = $request->username;
                        $member->update();
                        
                    }
                }

            } catch (\Throwable $th) {
                Log::info('Failed updated member = '.$th);
                DB::rollback();
                return redirect()->back()->with('error', 'Failed updated member'.$th);
            }
                DB::commit();
                return redirect()->route('admin-member-index')->with('success','Member Successfully Created');
            }

            return view('pages/admin/member/edit',compact('data'));
    
    }
}
