<?php

namespace  App\Repositories;

use App\Models\Tag;
use App\Services\Contracts\TagInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\TagDataTable;
use Illuminate\Support\Facades\DB;
class TagRepository implements TagInterface
{
    public function index(TagDataTable $tagDataTable)
    {
        return $tagDataTable->render('dashboard.admin.tags.index', ['pageTitle' => 'الكلمات المفتاحيه']);
    }

    public function create()
    {
        return view('dashboard.admin.tags.create', ['pageTitle' => 'الكلمات المفتاحيه']);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $type = Tag::create();
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $type->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
            }
            $type->save();
            DB::commit();
            return redirect()->route('admin.tags.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.admin.tags.edit', ['pageTitle' => 'تعديل نوع', 'tag' => $tag]);
    }

    public function update(Request $request, Tag $tag)
    {
        DB::beginTransaction();
        try {
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $tag->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
            }

            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'تم الحذف بنجاح!');
    }
}
