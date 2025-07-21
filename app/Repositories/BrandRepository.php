<?php

namespace  App\Repositories;

use App\Models\{Brand, Category};
use App\Services\Contracts\BrandInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\BrandDataTable;
use Illuminate\Support\Facades\DB;

class BrandRepository implements BrandInterface
{
    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('dashboard.admin.brands.index', ['pageTitle' => 'الماركات']);
    }

    public function create()
    {
        $categories = Category::rootActive()->get();
        return view('dashboard.admin.brands.create', ['pageTitle' => 'إضافة ماركه', 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);
        DB::beginTransaction();
        try {
            $brand = Brand::create([
                'category_id' => $request->category_id,
            ]);
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $brand->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $brand->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $brand->save();
            if ($request->hasFile('brand'))
                $brand->uploadSingleMedia('brand', $request->file('brand'), $brand, null, 'media', true);
            DB::commit();
            return redirect()->route('admin.brands.index')->with('success', 'تم حفظ الماركه بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Brand $brand)
    {
        $brand->load(['media', 'category']);
        $categories = Category::rootActive()->get();
        return view('dashboard.admin.brands.edit', [
            'pageTitle' => 'تعديل الماركه: ',
            'brand' => $brand,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
        ]);
        DB::beginTransaction();
        try {
            $brand->update([
                'category_id' => $request->category_id,
            ]);
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $brand->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $brand->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $brand->save();
            if ($request->hasFile('brand'))
                $brand->updateSingleMedia('brand', $request->file('brand'), $brand, null, 'media', true);
            DB::commit();
            return redirect()->route('admin.brands.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء تحديث البيانات: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Brand $brand)
    {
        $brand->deleteExistingMedia('brand', $brand, null, 'media', true, 'brand');
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'تم الحذف بنجاح!');
    }
}
