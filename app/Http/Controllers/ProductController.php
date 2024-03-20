<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('Author:id,name,email')->paginate(10);

        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'not found',
                'message' => 'Belum ada products'
            ]);
        }

        return ProductResource::collection($products);
    }
}
