<?php

namespace  App\Repositories;

use App\Models\AboutCounter;
use App\Services\Contracts\AboutCounterInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\AboutCounterDataTable;
use Illuminate\Support\Facades\DB;

class AboutCounterRepository implements AboutCounterInterface
{
    public function index(AboutCounterDataTable $aboutCounterDataTable)
    {
        return $aboutCounterDataTable->render('dashboard.admin.aboutCounters.index', ['pageTitle' => 'عدادات من نحن']);
    }

    public function create()
    {
        return view('dashboard.admin.aboutCounters.create', ['pageTitle' => 'إضافة بيانات']);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $aboutCounter = AboutCounter::create();
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $aboutCounter->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $aboutCounter->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $aboutCounter->save();
            DB::commit();
            return redirect()->route('admin.aboutCounters.index')->with('success', 'تم حفظ الصورة بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(AboutCounter $aboutCounter)
    {
        return view('dashboard.admin.aboutCounters.edit', [
            'pageTitle' => 'تعديل : ',
            'aboutCounter' => $aboutCounter,
        ]);
    }

    public function update(Request $request, AboutCounter $aboutCounter) {
        $request->validate([
            'ar.name' => 'required|string|max:255',
            'ar.description' => 'nullable|string',
            'en.name' => 'required|string|max:255',
            'en.description' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try {
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $aboutCounter->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $aboutCounter->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $aboutCounter->save();
            DB::commit();

            return redirect()->route('admin.aboutCounters.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(AboutCounter $aboutCounter) {
        $aboutCounter->delete();
        return redirect()->route('admin.aboutCounters.index')->with('success', 'تم الحذف بنجاح!');
    }
}
