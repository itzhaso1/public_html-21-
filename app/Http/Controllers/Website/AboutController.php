<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\{About, AboutCounter, Category};
class AboutController extends Controller {
    public function __invoke() {
        $about = About::with(['translations', 'media',])->latest()->first();
        /*$aboutImg = $about->getMediaUrl('about', $about, null, 'media', 'about');*/
        $aboutImg = $about?->getMediaUrl('about', $about, null, 'media', 'about') ?? asset('assets/default/default.jpg');
        $aboutCounters = AboutCounter::with(['translations'])->get();
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();
        return view('website.pages.about_us', [
            'pageTitle' => trans('site/site.about_us'),
            'categories' => $categories,
            'about' => $about,
            'aboutCounters' => $aboutCounters,
            'aboutImg' => $aboutImg
        ]);
    }
}
