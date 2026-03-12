<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductHomeResource;
use App\Models\Product;

class ProductHomeController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category:id,name,slug',
            'brand:id,name,slug',
            'gender:id,name,slug',
            'media'
        ])->where('is_active', 1)
        ->withMin('productVariants', 'price')->latest()->paginate(10);
        // return response()->json($products);
        return ProductHomeResource::collection($products);
    }
}
