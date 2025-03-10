<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __invoke(Request $request, Product $product)
    {
        return Inertia::render('Product', [
            'product' => $product,
            'category' => $product->category,
            'relatedProducts' => Product::where('category_id', '=', $product->category_id)
                ->take(3)
                ->get(),
        ]);
    }
}
