<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __invoke(Request $request, ProductCategory $productCategory)
    {
        return Inertia::render('Category', [
            'category' => $productCategory,
            'products' => Product::where('category_id', $productCategory->id)->get(),
        ]);
    }
}
