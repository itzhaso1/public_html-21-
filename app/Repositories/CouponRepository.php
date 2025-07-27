<?php

namespace  App\Repositories;

use App\DataTables\Dashboard\Admin\CouponDataTable;
use App\Models\{Coupon, Product, Category};
use App\Services\Contracts\CouponInterface;
use Illuminate\Http\Request;

class CouponRepository implements CouponInterface {
    protected $coupon;
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('dashboard.admin.coupons.index', ['pageTitle' => 'الكوبونات']);
    }

    public function create() {
        $products = Product::get()->pluck('name', 'id')->toArray();
        $categories = Category::whereStatus('active')->get()->pluck('name', 'id')->toArray();
        return view('dashboard.admin.coupons.create', [
            'pageTitle' => 'الكوبونات',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric',
            'min_spend' => 'nullable|numeric',
            'max_spend' => 'nullable|numeric',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'products' => 'array',
            'excluded_products' => 'array',
            'categories' => 'array',
            'excluded_categories' => 'array',
        ]);
        $coupon = Coupon::create($data);
        $coupon->products()->sync($request->products ?? []);
        $coupon->excludedProducts()->sync($request->excluded_products ?? []);
        $coupon->categories()->sync($request->categories ?? []);
        $coupon->excludedCategories()->sync($request->excluded_categories ?? []);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created.');
    }

    public function edit(Coupon $coupon) {
        $products = Product::get()->pluck('name', 'id')->toArray();
        $categories = Category::whereStatus('active')->get()->pluck('name', 'id')->toArray();

        return view('dashboard.admin.coupons.edit', [
            'coupon' => $coupon,
            'products' => $products,
            'categories' => $categories,
            'pageTitle' => 'تعديل كوبون'
        ]);
    }

    public function update(Request $request, Coupon $coupon) {
        $data = $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric',
            'min_spend' => 'nullable|numeric',
            'max_spend' => 'nullable|numeric',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'products' => 'array',
            'excluded_products' => 'array',
            'categories' => 'array',
            'excluded_categories' => 'array',
        ]);
        $coupon->update($data);
        $coupon->products()->sync($request->products ?? []);
        $coupon->excludedProducts()->sync($request->excluded_products ?? []);
        $coupon->categories()->sync($request->categories ?? []);
        $coupon->excludedCategories()->sync($request->excluded_categories ?? []);
        return redirect()->route('admin.coupons.index')->with('success', 'تم تحديث الكوبون بنجاح.');
    }


    public function destroy(Coupon $coupon) {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'تم الحذف بنجاح!');
    }

    
}