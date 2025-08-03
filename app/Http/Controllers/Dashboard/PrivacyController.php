<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PrivacyController extends Controller {
    public function index()
    {
        $privacy = Privacy::with('translations')->get();
        $pageTitle = 'سياسه الخصوصيه';
        return view('dashboard.admin.privacy.index', compact('privacy', 'pageTitle'));
    }

    public function create()
    {
        return view('dashboard.admin.privacy.create', ['pageTitle' => 'إضافة سياسة الخصوصية']);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|array',
            'description' => 'required|array',
        ]);

        $translations = [];
        foreach ($data['title'] as $locale => $title) {
            $translations[$locale] = [
                'title' => $title,
                'description' => $data['description'][$locale],
            ];
        }

        Privacy::create($translations);

        return redirect()->route('admin.privacy.index')->with('success', 'تم الحفظ');
    }

    public function edit(Privacy $privacy)
    {
        $pageTitle = 'تعديل سياسة الخصوصية';
        return view('dashboard.admin.privacy.edit', compact('privacy', 'pageTitle'));
    }


    public function update(Request $request, Privacy $privacy) {
        $data = $request->validate([
            'title' => 'required|array',
            'description' => 'required|array',
        ]);
        foreach ($data['title'] as $locale => $title) {
            $privacy->translateOrNew($locale)->title = $title;
            $privacy->translateOrNew($locale)->description = $data['description'][$locale];
        }
        $privacy->save();
        return redirect()->route('admin.privacy.index')->with('success', 'تم التحديث');
    }

    public function destroy(Privacy $privacy)
    {
        $privacy->delete();
        return redirect()->route('admin.privacy.index')->with('success', 'تم حذف سياسة الخصوصية بنجاح');
    }
}