<?php

namespace App\Http\Controllers\Admin\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function store(Request $request){
        if ($request->action == 'create'){
            

            $validator = Validator::make($request->all(), [
            'title' => 'required',
            'pub_year' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Validation required');
            }

            DB::beginTransaction();
            try {
                
                $image = $request->file('photo');
                $image->storeAs('public/book', $image->hashName());

                $data = Book::create([
                    'photo'     => $image->hashName(),
                    'code_book'     => codeBook(),
                    'user_id'     => Auth::guard('admin')->user()->id,
                    'title'     => $request->title,
                    'pub_year'   => $request->pub_year,
                    'author'   => $request->author,
                    'stock'   => $request->stock,
                ]);
    
            } catch (\Throwable $th) {
                Log::info('Failed created book = '.$th);
                DB::rollback();
                return redirect()->back()->with('error', 'Failed created new a book'.$th);
            }
                DB::commit();
                return redirect()->route('admin-book-index')->with('success','Book Successfully Created');
            }

        return view('pages/admin/book/create');
    }
}
