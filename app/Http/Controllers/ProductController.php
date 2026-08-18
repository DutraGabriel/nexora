<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'images' => fn ($query) => $query
                ->orderByDesc('is_primary')
                ->orderBy('sort_order'),
            'variants.offers' => fn ($query) => $query->where('is_active', true),
        ])->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'images',
            'variants.attributeValues',
            'attributes.values',
            'variants.offers.store',
        ]);

        return view('products.show', compact('product'));
    }
}
