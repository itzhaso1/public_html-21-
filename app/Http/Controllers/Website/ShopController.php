<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category,Brand};
class ShopController extends Controller {
    public function index(Request $request) {
        $products = Product::query()->with(['translations', 'media']);
        if ($request->filled('category_id')) {
            $products->where('category_id', $request->category_id);
        }
        if ($request->filled('brand_id')) {
            $products->where('brand_id', $request->brand_id);
        }
        if ($request->filled('min_price')) {
            $products->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $products->where('price', '<=', $request->max_price);
        }
        $products = $products->latest()->paginate(12);
        $categories = Category::with('translations')->get();
        $subcategories = Category::whereNotNull('parent_id')->with(['translations', 'media'])->get();
        $brands = Brand::all();
        $pageTitle = trans('site/site.shop');
        return view('website.pages.shop', compact('products', 'categories', 'brands', 'pageTitle', 'subcategories'))->with([
            'breadcrumbs' => [
                ['title' => trans('site/site.shop')],
            ]
        ]);
    }

    public function show($id) {
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();
        $product = Product::with(['translations', 'media', 'category', 'brand', 'type', 'tags', 'sections'])->findOrFail($id);
        $relatedProducts = Product::with(['translations', 'media'])
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('status', 'published')
        ->take(10)
        ->get();
        return view('website.pages.products_show', compact('product', 'categories', 'relatedProducts'))->with(
                [
                    'breadcrumbs' => [
                        ['title' => trans('site/site.shop'), 'url' => route('shop.index')],
                        ['title' => $product->name]
                ]
            ]
        );
    }

}