<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    
   public function index(){
        $genres = Genre::all();
        
        if($genres->isEmpty()){
            return response()->json([
                "success" => true,
                "message" => "Resource not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $genres

        ], 200);

    }

     public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max: 255',
            'description' => 'required|string',
        ]);

        // 2. Check Validator
        if ($validator ->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()
            ], 422);
        }

        // 3. Insert data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // 4. Response
        return response()->json([
            "success" => true,
            "message" => "Resource added successfully",
            "data" => $genre
        ], 201);
    }

     public function show($id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get Detail Resource",
            "data" => $genre
        ], 200);
    }


    public function update(string $id, Request $request){
        // 1. Cari data berdasarkan ID
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        // 2. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
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
            'name' => $request->name,
            'description' => $request->description,
        ];

        // 5. Update data baru ke dalam database
        $genre->update($data);

        // 6. Response
        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully",
            "data" => $genre
        ], 200);

    }


    public function destroy($id){
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        $genre->delete();

        return response()->json([  
            "success" => true,
            "message" => "Resource deleted successfully"
        ], 200);
    }
           
}