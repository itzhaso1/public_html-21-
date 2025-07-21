<?php

namespace  App\Repositories;

use App\Models\Type;
use App\Services\Contracts\TypeInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\TypeDataTable;
use Illuminate\Support\Facades\DB;
class TypeRepository implements TypeInterface
{
    public function index(TypeDataTable $typeDataTable) {
        return $typeDataTable->render('dashboard.admin.types.index', ['pageTitle' => 'الوحدات']);
    }

    public function create()
    {
        return view('dashboard.admin.types.create', ['pageTitle' => 'الوحدات']);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $type = Type::create();
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $type->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
            }
            $type->save();
            DB::commit();
            return redirect()->route('admin.types.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }


    public function edit(Type $type)
    {
        return view('dashboard.admin.types.edit', ['pageTitle' => 'تعديل وحده', 'extra' => $type]);
    }

    public function update(Request $request, Type $type) {
        DB::beginTransaction();
        try {
            foreach (config('laravellocalization.supportedLocales') as $locale => $lang) {
                $type->translateOrNew($locale)->name = $request[$locale]['name'] ?? '';
            }

            $type->save();
            DB::commit();
            return redirect()->route('admin.types.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'تم الحذف بنجاح!');
    }
}
