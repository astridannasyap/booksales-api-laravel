<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

   public function index(){
        $books = Book::with('genre', 'author')->get();

        if($books->isEmpty()){
            return response()->json([
                "success" => true,
                "message" => "Resource not found!"
            ], 200);
        }


        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $books

        ], 200);
    }

    public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        // 2. Check Validator
        if ($validator ->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }

        // 3. Upload Image
        $image = $request->file('cover_photo');
        $image->store('books, public');

        // 4. Insert data
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'cover_photo' => $image->getClientOriginalName(),
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,
        ]);


        // 5. Response
        return response()->json([
            "success" => true,
            "message" => "Resource added successfully",
            "data" => $book
        ], 201);
    }

    public function show($id){
        $book = Book::with('genre', 'author')->find($id);

        if(!$book){
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get Detail Resource",
            "data" => $book
        ], 200);
    }

    public function update(string $id, Request $request){
        // 1. Cari data berdasarkan ID
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        // 2. Validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }

        // 3. Menangani upload gambar baru jika ada

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id,

        ];

        // 4. Handle image (Upload & delete image)
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            if ($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            $data['cover_photo'] = $image->getClientOriginalName();
        }

        // 5. Update data baru ke dalam database
        $book->update($data);

        // 6. Response
        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully",
            "data" => $book
        ], 200);

    }

    public function destroy($id){
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        $book->delete();

        return response()->json([
            "success" => true,
            "message" => "Resource deleted successfully"
        ], 200);
    }
}
