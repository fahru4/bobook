<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use DataTables;

class IndexController extends Controller
{
    public function index(Request $request){
            $data = Transaction::select('transactions.*', 'books.*')->join('books','transactions.book_id','=','books.id')->get();
                        
            return view('pages/admin/transaction/index',compact('data'));

    }
    public function status(Request $request, $id){
        $transaction = Transaction::where('id', $id)->first();

        DB::beginTransaction();
        try {
            
        if(!$transaction->approve > 0){
            
            $transaction->user_id = Auth::guard('admin')->user()->id;
            $transaction->approve = 1;

            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock -1),
                ]);
        } else {

            $transaction->user_id = 0;
            $transaction->approve = 0;
    
            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock +=1),
                ]);
        }

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'message' => 'Error',
                'status' => 500,
                'error' => true,
            ]);
        }
            DB::commit();
            return response()->json([
                'message' => 'success',
                'status' => 200,
                'error' => false,
            ]);        
    
    }

    public function approve(Request $request, $id){
        $transaction = Transaction::where('id', $id)->first();

        DB::beginTransaction();
        try {
            
        if(!$transaction->approve > 0){
            
            $transaction->user_id = Auth::guard('admin')->user()->id;
            $transaction->approve = 1;

            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock -1),
                ]);
        } else {

            $transaction->user_id = 0;
            $transaction->approve = 0;
    
            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock +=1),
                ]);
        }

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'message' => 'Error',
                'status' => 500,
                'error' => true,
            ]);
        }
            DB::commit();
            return response()->json([
                'message' => 'success',
                'status' => 200,
                'error' => false,
            ]);        
    
        
    }
}
