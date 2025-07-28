<?php

namespace  App\Repositories;

use App\Models\{Page,FooterGroup};
use App\Services\Contracts\PageInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\PageDataTable;

class PageRepository implements PageInterface {
    public function index(PageDataTable $pageDataTable) {
        return $pageDataTable->render('dashboard.admin.pages.index', ['pageTitle' => 'الصفحات و المجموعات']);
    }

    public function createGroup() {
        return view('dashboard.admin.pages.groups.create', ['pageTitle' => 'اضافه مجموعه']);
    }

    public function storeGroup(Request $request)
    {
        $data = $request->validate([
            'status' => 'required|boolean',
            'name'   => 'required|array',
            'name.*' => 'required|string',
        ]);

        $group = new FooterGroup();
        $group->status = $data['status'];
        foreach ($data['name'] as $locale => $value) {
            $group->translateOrNew($locale)->name = $value;
        }
        $group->save();

        return redirect()->route('dashboard.groups.index')->with('success', 'Group created');
    }
}