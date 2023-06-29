<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use DataTables;

class IndexController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = book();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn= '<a href="book/edit/'. $row->id .'" class="btn btn-primary">Edit</a>';
                        // $btn = ';
                        // <button type="button" class="btn btn-success btn-sm" id="getBook" data-id="'.$row->id.'">Edit</button>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" 
                        data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages/admin/book/index');
    }

    public function delete($id){
        Book::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }

    public function clear($id){
        $data =Book::find($id)->first();
        dd($data);
        
        if ($data->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Your file has been deleted.',
                'error' => false,

            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Your failed to delete.',
            'error' => true,
        ]);
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
}
