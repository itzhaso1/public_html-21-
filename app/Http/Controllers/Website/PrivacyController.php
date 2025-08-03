<?php
namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\{Privacy, Category};
class PrivacyController extends Controller {
    public function __invoke()
    {
        $privacy = Privacy::get();
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();
        return view('website.pages.privacy', [
            'pageTitle' => trans('site/site.privacy_page'),
            'categories' => $categories,
            'privacy' => $privacy,
        ]);
    }
}