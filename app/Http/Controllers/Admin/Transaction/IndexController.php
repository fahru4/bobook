<?php

namespace App\Http\Controllers\Admin\Transaction;

use DataTables;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index(Request $request){
            $data = Transaction::select('transactions.*', 'books.title','books.pub_year','books.author','books.photo')->join('books','transactions.book_id','=','books.id')->get();
                        
            return view('pages/admin/transaction/index',compact('data'));

    }
    public function status(Request $request, $id){
        $transaction = Transaction::findOrFail($id);
        DB::beginTransaction();
        try {
            
            
        if($transaction->approve == 0){
            
            $transaction->user_id = 1;
            $transaction->approve = 1;
            $transaction->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock -1),
                ]);
            
        }else if($transaction->approve == 1) {

            $transaction->user_id = 0;
            $transaction->approve = 0;
    
            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock +=1),
                ]);
        }else{
            return response()->json([
                'message' => 'No Approve',
                'status' => 500,
                'error' => true,
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
                'message' => $transaction->approve == 0 ? 'Approval successful +1 stock book  ' .$transaction->books->title. '' : 
                'Approval successful -1 stock book ' .$transaction->books->title. '',
                'status' => 200,
                'error' => false,
            ]);      

    }

    public function approve($id){
        $transaction = Transaction::findOrFail($id);
        DB::beginTransaction();
        try {
            
            
        if($transaction->approve == 0){
            
            $transaction->user_id = 1;
            $transaction->approve = 1;

            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock -1),
                ]);
        }else if($transaction->approve == 1) {

            $transaction->user_id = 0;
            $transaction->approve = 0;
    
            $transaction->update();
            $transaction->books->where('id', $transaction->books->id)
            ->update([
                'stock' => ($transaction->books->stock +=1),
                ]);
        }else{
            return response()->json([
                'message' => 'No Approve',
                'status' => 500,
                'error' => true,
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
                'message' => 'Success Approve',
                'status' => 200,
                'error' => false,
            ]);        
    
        
    }
}
