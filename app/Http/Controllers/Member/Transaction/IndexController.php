<?php

namespace App\Http\Controllers\Member\Transaction;

use App\Http\Controllers\Controller;
// use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            // $data = Book::select('books.*')->join('transactions','transactions.book_id','=','books.user_id')->where('user_id', $request->user_id)->first();
            $data = Transaction::select('transactions.*', 'books.*')->join('books','transactions.book_id','=','books.id')
        -> where('member_id', Auth::guard('member')->user()->id)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('span', function($data){
                                    if($data->approve == 0){
                                        return  '<span class="badge badge-info">No Approve</span>'; 
                                    }
                                    return  '<span class="badge badge-secondary">Is Approve</span>'; 
                    
                    })
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action','span'])
                    ->make(true);
        }
        return view('pages/member/transaction/index');

    }
}
