<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();

        if($authors->isEmpty()){
            return response()->json([
                "success" => true,
                "message" => "Resource not found!"
            ], 200);
        }
        
        return response()->json([
            "success" => true,
            "message" => "Get All Resource",
            "data" => $authors

        ], 200);
    }

     public function store(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max: 255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'required|string',
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
        $image = $request->file('photo');
        $image->store('authors, public');

        // 4. Insert data
        $author = Author::create([
            'name' => $request->name,
            'photo' => $image->hashName(),
            'bio' => $request->bio,
        ]);

        // 5. Response
        return response()->json([
            "success" => true,
            "message" => "Resource added successfully",
            "data" => $author
        ], 201);
    }
}

