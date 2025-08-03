<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
class AboutController extends Controller {
    public function create() {
        $about = About::with('translations')->first();
        return view('dashboard.admin.about.create', ['pageTitle' => 'من نحن', 'about' => $about]);
    }

    public function store(Request $request) {
        $data = [];
        foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
            $data[$locale] = [
                'title' => $request->input("$locale.title"),
                'description' => $request->input("$locale.description"),
                'short_description' => $request->input("$locale.short_description"),
                'content_title' => $request->input("$locale.content_title"),
                'content_description' => $request->input("$locale.content_description"),
                'content_note' => $request->input("$locale.content_note"),
            ];
        }
        $about = About::with('translations')->first();

        if ($about) {
            $about->update($data);
        } else {
            $about = About::create($data);
        }
        if ($request->hasFile('about'))
            $about->updateSingleMedia('about', $request->file('about'), $about, null, 'media', true);
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }
}