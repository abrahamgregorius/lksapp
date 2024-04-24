<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::get();

        return response()->json([
            'product' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'image' => asset($product->image),
                    'price' => $product->price,
                    'description' => $product->description,
                    'created_at' => $product->created_at,
                ];
            })
        ]);
    }

    public function store(Request $request) {
        $slug = str($request->title)->slug();
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->move("/images/$slug", 'image.png');
        }

        Product::create([
            'id' => $request->id,
            'image' => "/images/$slug/image.png",
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => $request->created_at,
        ]);

        return response()->json([
            'message' => 'Product created'
        ]);
    }
}
