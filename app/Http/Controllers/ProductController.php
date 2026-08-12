<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
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
