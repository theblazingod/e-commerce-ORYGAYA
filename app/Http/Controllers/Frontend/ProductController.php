<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BrowsingHistory;
use App\Models\ProductCategory;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::all();

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'name',
                'price',
                'created_at',
                AllowedFilter::scope('price_min'),
                AllowedFilter::scope('price_max'),
            ])
            ->allowedSorts(['name', 'price', 'created_at'])
            ->when($request->has('category'), function ($query) use ($request) {
                $category = ProductCategory::where('slug', $request->input('category'))->first();
                if ($category) {
                    $query->where('category_id', $category->id);
                }
            });

        if ($request->has('search')) {
            $products->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $products = $products->paginate(config('pagination.per_page'))
            ->appends($request->query());

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {


        // // Get recommendations
        // $recommendations = [];
        // if (auth()->check()) {
        //     $recommendations = $this->recommendationService->getRecommendations(\Illuminate\Support\Facades\Auth::user());
        // }

        // $metaTitle = $product->meta_title ?? $product->name;
        // $metaKeywords = $product->meta_keywords;
        // $canonicalUrl = route('products.show', ['category' => $category, 'product' => $product->slug]);

        $previousProduct = Product::where('id', '<', $product->id)->orderBy('id', 'desc')->first();
        $nextProduct = Product::where('id', '>', $product->id)->orderBy('id', 'asc')->first();

        return view('products.show', compact('product', 'previousProduct', 'nextProduct'));
    }


    // public function create(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'price' => 'required|numeric',
    //         'category' => 'required|string|max:255',
    //         'inventory_count' => 'required|integer',

    //     ]);

    //     $product = Product::create($validatedData);

    //     // Create an initial inventory log entry
    //     $product->inventoryLogs()->create([
    //         'quantity_change' => $validatedData['inventory_count'],
    //         'reason' => 'Initial stock setup',
    //     ]);

    //     return response()->json($product, Response::HTTP_CREATED);
    // }

    // public function update(Request $request, $id)
    // {
    //     $product = Product::find($id);

    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
    //     }

    //     $validatedData = $request->validate([
    //         'name' => 'string|max:255',
    //         'description' => 'string',
    //         'price' => 'numeric',
    //         'category' => 'string|max:255',
    //         'inventory_count' => 'integer',
    //     ]);

    //     // Handle Product File Upload for Update
    //     if ($request->hasFile('product_file')) {
    //         $file = $request->file('product_file');


    //     }

    //     $product->update($validatedData);

    //     return response()->json($product);
    // }

    // public function delete($id)
    // {
    //     $product = Product::find($id);

    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
    //     }

    //     $product->delete();

    //     return response()->json(['message' => 'Product deleted successfully']);
    // }

    // public function addToCompare(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);
    //     $compareList = Session::get('compare_list', []);

    //     if (!in_array($id, $compareList) && count($compareList) < 4) {
    //         $compareList[] = $id;
    //         Session::put('compare_list', $compareList);
    //         return redirect()->back()->with('success', 'Product added to comparison.');
    //     } elseif (in_array($id, $compareList)) {
    //         return redirect()->back()->with('info', 'Product is already in the comparison list.');
    //     } else {
    //         return redirect()->back()->with('error', 'You can compare up to 4 products at a time.');
    //     }
    // }

    // public function compare()
    // {
    //     $compareList = Session::get('compare_list', []);
    //     $products = Product::whereIn('id', $compareList)->get();

    //     return view('products.compare', compact('products'));
    // }

    // public function removeFromCompare($id)
    // {
    //     $compareList = Session::get('compare_list', []);
    //     $compareList = array_diff($compareList, [$id]);
    //     Session::put('compare_list', $compareList);

    //     return redirect()->back()->with('success', 'Product removed from comparison.');
    // }

    // public function clearCompare()
    // {
    //     Session::forget('compare_list');
    //     return redirect()->route('products.list')->with('success', 'Comparison list cleared.');
    // }
}
