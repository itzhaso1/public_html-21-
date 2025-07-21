<?php

namespace  App\Repositories;

use App\DataTables\Dashboard\Admin\CouponDataTable;
use App\Models\Coupon;
use App\Services\Contracts\CouponInterface;
use Illuminate\Http\Request;

class CouponRepository implements CouponInterface
{
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('dashboard.admin.coupons.index', ['pageTitle' => 'الكوبونات']);
    }

    public function create()
    {
        return view('dashboard.admin.coupons.create', ['pageTitle' => 'الكوبونات']);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'from' => 'required|date|max:255',
            'to' => 'required|date|max:255',
            'fixed' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'percentage' => 'nullable|string|max:255',
        ]);
        if ($request->from < date("Y-m-d")) {
            return back()->withErrors(['from' => 'تاريخ البداية يجب أن يكون بعد تاريخ اليوم.'])->withInput();
        }
        if ($request->from > $request->to) {
            return back()->withErrors(['from' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية.'])->withInput();
        }
        Coupon::create($request->all());
        return redirect()->route('admin.coupons.index')->with('success', 'تم حفظ بنجاح!');
    }

    public function edit(Coupon $coupon)
    {
        return view('dashboard.admin.coupons.edit', ['pageTitle' => 'تعديل كوبون', 'coupon' => $coupon]);
    }

    public function update(Request $request, Coupon $coupon) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'from' => 'required|date|max:255',
            'to' => 'required|date|max:255',
            'status' => 'required|string|max:255',
            'fixed' => 'nullable|string|max:255',
            'percentage' => 'nullable|string|max:255',
        ]);
        if ($request->from !== $coupon->from && $request->from < date("Y-m-d")) {
            return back()->withErrors(['from' => 'تاريخ البداية يجب أن يكون اليوم أو بعده.'])->withInput();
        }

        if ($request->from > $request->to) {
            return back()->withErrors(['from' => 'تاريخ البداية يجب أن يكون قبل تاريخ النهاية.'])->withInput();
        }

        if ($request->type === 'fixed' && empty($request->fixed)) {
            return back()->withErrors(['fixed' => 'السعر الثابت مطلوب عند اختيار نوع "سعر ثابت".'])->withInput();
        }

        if ($request->type === 'percentage') {
            if (empty($request->percentage)) {
                return back()->withErrors(['percentage' => 'النسبة مطلوبة عند اختيار نوع "نسبة مئوية".'])->withInput();
            }

            if ((float)$request->percentage > 99) {
                return back()->withErrors(['percentage' => 'النسبة يجب ألا تزيد عن 99%.'])->withInput();
            }
        }
        $coupon->update($request->all());
        return redirect()->route('admin.coupons.index')->with('success', 'تم الحفظ بنجاح!');
    }



    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'تم الحذف بنجاح!');
    }
}