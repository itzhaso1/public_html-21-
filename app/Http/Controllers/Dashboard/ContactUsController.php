<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function create()
    {
        $contactUs = ContactUs::with('translations')->first();
        return view('dashboard.admin.contactus.create', ['pageTitle' => 'اتصل بنا', 'contactUs' => $contactUs]);
    }

    public function store(Request $request) {
        $data = [];
        foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
            $data[$locale] = [
                'title' => $request->input("$locale.title"),
                'description' => $request->input("$locale.description"),
                'content_title' => $request->input("$locale.content_title"),
                'content_description' => $request->input("$locale.content_description"),
            ];
        }
        $contactUs = ContactUs::with('translations')->first();

        if ($contactUs) {
            $contactUs->update($data);
        } else {
            $contactUs = ContactUs::create($data);
        }
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }
}