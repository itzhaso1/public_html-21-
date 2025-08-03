<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\{ContactUs, Category};

class ContactUsController extends Controller
{
    public function __invoke()
    {
        $contact = ContactUs::with(['translations', ])->latest()->first();
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();
        return view('website.pages.contact_us', [
            'pageTitle' => trans('site/site.contact_us'),
            'categories' => $categories,
            'contact' => $contact,
        ]);
    }
}