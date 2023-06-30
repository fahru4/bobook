<?php

namespace App\Http\Controllers\Member\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Member;
use App\Models\Transaction;

class StoreController extends Controller
{
    public function store(Request $request){
        if ($request->action == 'create'){
            

            $validator = Validator::make($request->all(), [
                'date_loan' => 'required',
                'date_return' => 'required',
                'book_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation Failed',
                    'status' => 400,
                    'error' => true,
                    'data' => $validator->errors()
                ]);
            }

            DB::beginTransaction();
            try {
                $member = Member::where('id', Auth::guard('member')->user()->id)->first();
                $transaction = Transaction::where('approve', 1)->where('member_id', $member->id)->exists();
                if($transaction){
                    return redirect()->route('member-transaction')->with('warning', 'You have borrow the book');
                }
                $data = Transaction::create([
                    'member_id'=> Auth::guard('member')->user()->id,
                    'book_id'=>$request->book_id,
                    'date_loan'=>$request->date_loan,
                    'date_return'=>$request->date_return,
                ]);

                BookDetail::create([
                    'transaction_id' => $data->id,
                    'book_id' => $data->book_id
                ]);
    
            } catch (\Throwable $th) {
                Log::info('Failed to update transaksi 3 = '.$th);
                DB::rollback();
                return redirect()->back()->with('error', 'Failed Submit ');
            }
                DB::commit();
                return redirect()->route('member-transaction')->with('success','Book Successfully Booked');
            }
        
            $books = Book::where('stock', '>', 0)->get();
        return view('pages/member/transaction/create',compact('books'));
    }
}
