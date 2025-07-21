<?php

namespace  App\Repositories;

use App\Models\{Section,Product, Category};
use App\Services\Contracts\SectionInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\SectionDataTable;
use Illuminate\Support\Facades\DB;

class SectionRepository implements SectionInterface
{
    public function index(SectionDataTable $sectionDataTable)
    {
        return $sectionDataTable->render('dashboard.admin.sections.index', [
            'pageTitle' => 'الاقسام'
        ]);
    }

    public function create()
    {
        $orders = range(1, Section::count() + 1);
        $products = Product::all();
        $categories = Category::active()->get();
        return view('dashboard.admin.sections.create', [
            'pageTitle' => 'إضافة قسم',
            'orders' => $orders,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            if ($request->design_type === 'layout3' && (!is_array($request->category_ids) || empty(array_filter($request->category_ids, fn($id) => $id != 0)))) {
                return back()->with('error', 'يجب اختيار تصنيف واحد على الأقل عند استخدام تصميم 3')->withInput();
            }

            $section = Section::create([
                //'category_id' => $request->category_id ?? null,
                'order' => $request->filled('order') ? (int)$request->order : 0,
                'design_type' => $request->design_type ?? 'layout1',
            ]);
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $section->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $section->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $section->save();
            if ($request->has('category_ids')) {
                $section->categories()->sync($request->category_ids);
            }

            if ($request->has('product_ids')) {
                $section->products()->sync($request->product_ids);
            }
            DB::commit();
            return redirect()->route('admin.sections.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Section $section)
    {
        $orders = range(1, Section::count());
        $products = Product::all();
        $categories = Category::active()->get();

        return view('dashboard.admin.sections.edit', compact('section', 'orders', 'products', 'categories'));
    }

    public function update(Request $request, Section $section) {
        DB::beginTransaction();
        try {
            $section->update([
                //'category_id' => $request->category_id ?? null,
                'order' => $request->input('order', 0),
            ]);

            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $section->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $section->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }

            $section->save();

            $section->products()->sync($request->product_ids ?? []);
            $section->categories()->sync($request->category_ids ?? []);

            DB::commit();

            return redirect()->route('admin.sections.index')->with('success', 'تم التحديث بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'تم الحذف بنجاح!');
    }
}