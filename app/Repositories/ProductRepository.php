<?php

namespace App\Repositories;

use App\Models\{Product, Category, Type, Brand, Tag};
use App\Services\Contracts\ProductInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\ProductDataTable;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface {
    public function index(ProductDataTable $productDataTable) {
        return $productDataTable->render('dashboard.admin.products.index', [
            'pageTitle' => trans('dashboard/admin.product.products'),
        ]);
    }

    public function create() {
        $data = [
            'categories' => Category::active()->get(),
            'types' => Type::get(),
            'brands' => Brand::all(),
            'tags'       => Tag::all(),
        ];
        return view('dashboard.admin.products.form', ['pageTitle' => 'إضافة منتج', 'data' => $data]);
    }
    /*public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alt_name' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'types' => 'nullable|array',
            'types.*' => 'exists:types,id',
            'extras' => 'nullable|array',
            'extras.*' => 'exists:extras,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'sizes' => 'nullable|array',
            'sizes.*.size_id' => 'exists:sizes,id',
            'sizes.*.price' => 'required_if:sizes.*.size_id,!null|numeric|min:0',
            'loyalty_points' => 'nullable',
        ]);
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'short_description' => $validatedData['short_description'] ?? null,
            'price' => $validatedData['price'],
            'loyalty_points' => $validatedData['loyalty_points']
        ]);
        $product->categories()->attach($validatedData['categories']);
        if (!empty($validatedData['types'])) {
            $product->types()->attach($validatedData['types']);
        }
        if (!empty($validatedData['extras'])) {
            $product->extras()->attach($validatedData['extras']);
        }
        if (!empty($validatedData['sizes'])) {
            $sizesData = [];
            foreach ($validatedData['sizes'] as $size) {
                $sizesData[$size['size_id']] = ['price' => $size['price']];
            }
            $product->sizes()->attach($sizesData);
        }
        if ($request->hasFile('product'))
            $product->uploadMedia($request->file('product'), 'product', 'root');
        return redirect()->route('admin.products.index')->with('success', 'تم حفظ بنجاح!');
    }*/

    public function store(Request $request) {
        $data = $this->extractData($request);
        $product = Product::create($data);
        $product->tags()->sync($request->input('tags', []));
        if ($request->hasFile('product')) {
            $product->uploadSingleMedia('product', $request->file('product'), $product, null, 'media', true);
        }

        return redirect()->route('admin.products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function update(Request $request, Product $product) {
        $data = $this->extractData($request);
        $product->update($data);
        $product->tags()->sync($request->input('tags', []));
        if ($request->hasFile('product')) {
            $product->updateSingleMedia('product', $request->file('product'), $product, null, 'media', true);
        }
        return redirect()->route('admin.products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }


    public function edit(Product $product)
    {
        $data = [
            'categories' => Category::active()->get(),
            'types' => Type::get(),
            'brands' => Brand::all(),
            'tags' => Tag::all(),
        ];

        $product->load(['tags', 'media']);

        return view('dashboard.admin.products.form', [
            'pageTitle' => 'تعديل منتج',
            'product' => $product,
            'data' => $data,
        ]);
    }

    /*public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:255',
            'alt_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'sizes' => 'nullable|array',
            'sizes.*.size_id' => 'exists:sizes,id',
            'sizes.*.price' => 'required|numeric|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'types' => 'nullable|array',
            'types.*' => 'exists:types,id',
            'extras' => 'nullable|array',
            'extras.*' => 'exists:extras,id',
            'loyalty_points' => 'nullable',
        ]);
        try {
            DB::beginTransaction();
            $product->update([
                'name' => $request->name,
                'alt_name' => $request->alt_name,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'price' => $request->price,
                'loyalty_points' => $request->loyalty_points
            ]);

            $sizes = [];
            if ($request->has('sizes')) {
                foreach ($request->sizes as $size) {
                    $sizes[$size['size_id']] = ['price' => $size['price']];
                }
                $product->sizes()->sync($sizes);
            }

            if ($request->has('categories')) {
                $product->categories()->sync($request->categories);
            }

            if ($request->has('types')) {
                $product->types()->sync($request->types);
            }

            if ($request->has('extras')) {
                $product->extras()->sync($request->extras);
            }

            if ($request->hasFile('product'))
                $product->updateMedia($request->file('product'), 'product', 'root');
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'تم حفظ بنجاح!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '!حدث خطأ ما');
        }
        $product->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => (float) $request->price,
        ]);

    }*/


    public function destroy(Product $product)
    {
        $product->deleteExistingMedia('product', $product, null, 'media', true, 'product');
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم الحذف بنجاح!');
    }

    private function extractData(Request $request)
    {
        $data = $request->only([
            'slug',
            'category_id',
            'brand_id',
            'type_id',
            'price_before_discount',
            'price',
            'stock',
            'sku',
            'status',
            'featured',
        ]);

        // نضيف قيمة الـ featured كـ boolean
        $data['featured'] = $request->has('featured');

        // نضيف الترجمة لكل لغة
        foreach (config('translatable.locales') as $locale) {
            $data[$locale] = $request->input($locale);
        }

        return $data;
    }
}
