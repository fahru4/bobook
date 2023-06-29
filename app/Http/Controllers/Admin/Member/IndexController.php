<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use DataTables;


class IndexController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Member::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn= '<a href="member/edit/'. $row->id .'" class="btn btn-primary">Edit</a>';
                        // $btn = ';
                        // <button type="button" class="btn btn-success btn-sm" id="getBook" data-id="'.$row->id.'">Edit</button>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" 
                        data-original-title="Delete" class="btn btn-danger deleteMember">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages/admin/member/index');
    }

    public function delete($id){
        Member::find($id)->delete();
     
        return response()->json(['success'=>'Member deleted successfully.']);
    }
}
