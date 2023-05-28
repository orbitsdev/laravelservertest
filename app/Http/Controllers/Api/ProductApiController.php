<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Requests\CreateProductRequest;

class ProductApiController extends Controller
{
    

    public function create(CreateProductRequest $request){

        // return response()->json([$request->all()]);
        $validated = $request->validated();
        $photo = $validated['photo']; // Store the photo in a separate variable
        unset($validated['photo']); 
        $validated['tags'] = json_encode($validated['tags']);
    
        $new_product = Product::create($validated);
        $new_product->generateSlug();
        $new_product->save();
        FileController::uploadFile($photo ,$new_product);

        return response()->json(['success'=> true], 200);


    }




}
