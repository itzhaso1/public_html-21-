<?php

namespace  App\Repositories;

use App\Models\Slider;
use App\Services\Contracts\SliderInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\SliderDataTable;
use Illuminate\Support\Facades\DB;
class SliderRepository implements SliderInterface
{
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('dashboard.admin.sliders.index', ['pageTitle' => 'الصور المتحركه']);
    }

    public function create()
    {
        return view('dashboard.admin.sliders.create', ['pageTitle' => 'إضافة صوره']);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $slider = Slider::create();
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $slider->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $slider->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $slider->save();
            if ($request->hasFile('slider')) {
                $slider->uploadSingleMedia('slider', $request->file('slider'), $slider, null, 'media', true);
            }
            DB::commit();
            return redirect()->route('admin.sliders.index')->with('success', 'تم حفظ الصورة بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Slider $slider) {
        $slider->load('media');
        return view('dashboard.admin.sliders.edit', [
            'pageTitle' => 'تعديل الصورة: ',
            'slider' => $slider,
        ]);
    }

    public function update(Request $request, Slider $slider) {
        $request->validate([
            'ar.name' => 'required|string|max:255',
            'ar.description' => 'nullable|string',
            'en.name' => 'required|string|max:255',
            'en.description' => 'nullable|string',
            'slider' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);
        DB::beginTransaction();
        try {
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $slider->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
                $slider->translateOrNew($locale)->description = $request[$locale]['description'] ?? '';
            }
            $slider->save();
            if ($request->hasFile('slider')) {
                $slider->updateSingleMedia('slider', $request->file('slider'), $slider, null, 'media', true);
            }
            DB::commit();

            return redirect()->route('admin.sliders.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Slider $slider) {
        $slider->deleteExistingMedia('slider', $slider, null, 'media', true, 'slider');
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'تم الحذف بنجاح!');
    }
}
