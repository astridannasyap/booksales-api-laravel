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
}