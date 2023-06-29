<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;

class BookController extends Controller
{
    public function getAll()
    {
        $data = book();
        return response()->json([
            'message' => 'List Book Total ' . count($data) . '',
            'data' => $data,
            'status' => 200,
            'error' => false
        ]);
    }

    public function show($code)
    {

        $data = Book::where('code_book', $code)->first();
        if (!$data) {
            return response()->json(['message' => 'Code book not found'], 404);
        }
        return response()->json([
            'message' => 'Book Code ' . $code,
            'data' => $data,
            'status' => 200,
            'error' => false
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'pub_year' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'status' => 400,
                'error' => true,
                'data' => $validator->errors()
            ]);
        }
        // $randomNumber = random_int(100000, 999999);

        $image = $request->file('photo');
        $image->storeAs('public/book', $image->hashName());

        $data = Book::create([
            'photo'     => $image->hashName(),
            'code_book'     => codeBook(),
            'user_id'     => 1,
            'title'     => $request->title,
            'pub_year'   => $request->pub_year,
            'author'   => $request->author,
            'stock'   => $request->stock,
        ]);

        return response()->json([
            'status' => 201,
            'error' => false,
            'data' => $data,
            'message' => 'Create Book Successfully ' . $data['title']
        ]);
    }

    public function update(Request $request, $code)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'pub_year' => 'required',
            'author' => 'required',
            'stock' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'status' => 422,
                'error' => true,
                'data' => $validator->errors()
            ]);
        }

        if ($request->hasFile('photo')) {

            //upload image
            $image = $request->file('photo');
            $image->storeAs('public/book', $image->hashName());

            //delete old image
            Storage::delete('public/book/' . $image);

            //update book with new image
            $data = Book::where('code_book', $code)->first();
            if ($data) {

                $data->photo = $image->hashName();
                $data->title   = $request->title;
                $data->author   = $request->author;
                $data->stock   = $request->stock;
                $data->pub_year   = $request->pub_year;

                $data->update();

                return response()->json([
                    'message' => 'Update Successfully ' . $data->title,
                    'status' => 200,
                    'error' => false,
                ]);
            }

            return response()->json([
                'message' => 'Update fail',
                'status' => 500,
                'error' => true,
            ]);
        }
    }

    public function delete($code)
    {
        $data = Book::where('code_book', $code)->first();

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
    }
}
