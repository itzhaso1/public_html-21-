<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\{Category,Slider, Section};
class WebsiteController extends Controller {
    public function __invoke() {
        $sliders = Slider::with(['translations', 'media',])->latest()->get();
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();
        $featuredCategories = Category::query()
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->with(['translations', 'media'])
            ->get();
        $categoryCount = $categories->count();
        $slidesPerView = $categoryCount < 10 ? $categoryCount : 10;

        $sections = Section::with([
            'translations',
            'products.translations',
            'products.media',
            'categories.translations',
        ])
            ->orderBy('order')
            ->get();

        $categoryCount = $categories->count();
        $slidesPerView = $categoryCount < 10 ? $categoryCount : 10;

        return view('website.pages.home', ['pageTitle' => trans('site/site.home_page_title'),
            'categories' => $categories,
            'sliders' => $sliders,
            'featuredCategories' => $featuredCategories,
            'categoryCount' => $categoryCount,
            'slidesPerView' => $slidesPerView,
            'sections' => $sections,
        ]);
    }
}
