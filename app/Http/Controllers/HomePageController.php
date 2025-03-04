<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Homepage', [
            'favorites' => Product::where('featured', true)->take(3)->get(),
        ]);
    }
}
