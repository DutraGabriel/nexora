<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $products = Product::with([
            'category',
            'images' => fn ($query) => $query
                ->orderByDesc('is_primary')
                ->orderBy('sort_order'),
            'variants.offers' => fn ($query) => $query->where('is_active', true),
        ])
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::query()
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderBy('name')
            ->take(6)
            ->get();

        $activeOfferCount = Offer::where('is_active', true)->count();
        $storeCount = Offer::where('is_active', true)->distinct('store_id')->count('store_id');

        return view('home', compact('products', 'categories', 'activeOfferCount', 'storeCount'));
    }
}
