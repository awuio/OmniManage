<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with compiled aggregate statistics.
     */
    public function __invoke()
    {
        $categoriesCount = Category::count();
        $postsCount = Post::count();

        // Compile all product aggregate statistics into a single query to prevent database overload and reduce query count
        $productStats = Product::selectRaw('
            COUNT(*) as total_count,
            SUM(price * quantity) as total_value,
            SUM(CASE WHEN quantity = 0 THEN 1 ELSE 0 END) as out_of_stock,
            SUM(CASE WHEN quantity BETWEEN 1 AND 5 THEN 1 ELSE 0 END) as low_stock
        ')->first();

        $productsCount = $productStats->total_count ?? 0;
        $totalStockValue = $productStats->total_value ?? 0;
        $outOfStockCount = $productStats->out_of_stock ?? 0;
        $lowStockCount = $productStats->low_stock ?? 0;

        // Top 5 most viewed products
        $topProducts = Product::orderBy('views', 'desc')->take(5)->get();

        // Products grouped by category for the distribution chart
        $productsByCategory = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(6)
            ->get();

        $recentProducts = Product::with('category')->latest()->take(5)->get();
        $recentPosts = Post::with('category')->latest()->take(5)->get();

        return view('dashboard', compact(
            'categoriesCount',
            'productsCount',
            'postsCount',
            'totalStockValue',
            'outOfStockCount',
            'lowStockCount',
            'topProducts',
            'productsByCategory',
            'recentProducts',
            'recentPosts'
        ));
    }
}
