<?php

namespace App\Http\Controllers\Admin\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function update(Request $request, $id){
        $data = Book::where('id', $id)->first();
        
        if ($request->action == 'update'){
            
            $validator = Validator::make($request->all(), [
            'title' => 'required',
            'pub_year' => 'required',
            'author' => 'required',
            'stock' => 'required',
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
                    $image->storeAs('public/book', $image->hashName());
        
                    //delete old image
                    Storage::delete('public/book/' . $image);
        
                    //update book with new image
                    $book = Book::where('id', $id)->first();
                    if ($book) {
        
                        $book->photo = $image->hashName();
                        $book->title   = $request->title;
                        $book->author   = $request->author;
                        $book->stock   = $request->stock;
                        $book->pub_year   = $request->pub_year;
        
                        $book->update();
                        
                    }
                }

            } catch (\Throwable $th) {
                Log::info('Failed created book = '.$th);
                DB::rollback();
                return redirect()->back()->with('error', 'Failed '.$th);
            }
                DB::commit();
                return redirect()->route('admin-book-index')->with('success','Book Successfully Created');
            }

            return view('pages/admin/book/edit',compact('data'));
    
    }
}
