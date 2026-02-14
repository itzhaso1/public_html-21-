<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\{Category, Slider, Section, Product};

class WebsiteController extends Controller
{
    public function __invoke()
    {
        $sliders = Slider::with(['translations', 'media'])->latest()->get();

        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();

        $categoryCount = $categories->count();
        $slidesPerView = min($categoryCount, 10);

        $sections = Section::with([
            'translations',
            'products.translations',
            'products.media',
            'categories.translations',
        ])
            ->orderBy('order')
            ->get();

        $sectionProductIds = $sections->pluck('products')->flatten()->pluck('id')->unique();

        $products = Product::with(['translations', 'media'])
            ->where('status', 'published')
            ->whereNotIn('id', $sectionProductIds)
            ->whereNull('service_type')
            ->latest()
            ->get();

        return view('website.pages.home', [
            'pageTitle' => trans('site/site.home_page_title'),
            'categories' => $categories,
            'sliders' => $sliders,
            'featuredCategories' => $categories, // same as categories
            'categoryCount' => $categoryCount,
            'slidesPerView' => $slidesPerView,
            'sections' => $sections,
            'products' => $products,
        ]);
    }

    public function show(Product $product)
    {
        if (!empty($product->service_type)) {
            return view('website.diamonds.show_charge', compact('product'));
        }

        $product->load(['translations', 'media', 'videos']);
        $mainImage = $product->getMediaUrl('product', $product, null, 'media', 'product');
        $galleryImages = $product->getMultipleMediaUrls('product/gallery', $product, 'media', 'gallery');
        $productVideo = $product->videos->first();

        return view('website.pages.products_show', compact('product', 'mainImage', 'galleryImages', 'productVideo'));
    }
}
