<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category, Brand};

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->with(['translations', 'media']);

        // إخفاء منتجات الشحن من المتجر الرئيسي
        $products->whereNull('service_type');

        if ($request->filled('category_id')) {
            $categoryId = $request->category_id;
            $subCategoryIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
            $allCategoryIds = array_merge([$categoryId], $subCategoryIds);

            // إذا عدد المنتجات في القسم الرئيسي قليل، نضم الأقسام الفرعية
            $mainCount = Product::where('category_id', $categoryId)->whereNull('service_type')->count();
            if ($mainCount <= 3 && !empty($subCategoryIds)) {
                $products->whereIn('category_id', $allCategoryIds);
            } else {
                $products->where('category_id', $categoryId);
            }

            $subcategories = Category::where('parent_id', $categoryId)->with(['translations', 'media'])->get();
        } else {
            $subcategories = Category::with(['translations', 'media'])->get();
        }

        if ($request->filled('brand_id')) {
            $products->where('brand_id', $request->brand_id);
        }
        if ($request->filled('min_price')) {
            $products->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $products->where('price', '<=', $request->max_price);
        }

        $products = $products->latest()->paginate(12);
        $categories = Category::with('translations')->get();
        $brands = Brand::with('translations')->get();
        $pageTitle = trans('site/site.shop');

        return view('website.pages.shop', compact('products', 'categories', 'brands', 'pageTitle', 'subcategories'))->with([
            'breadcrumbs' => [
                ['title' => trans('site/site.shop')],
            ]
        ]);
    }

    public function show($id)
    {
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();

        $product = Product::with(['translations', 'media', 'category.translations', 'brand.translations', 'type.translations', 'tags', 'sections'])->findOrFail($id);

        $relatedProducts = Product::with(['translations', 'media'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->whereNull('service_type')
            ->take(10)
            ->get();

        return view('website.pages.products_show', compact('product', 'categories', 'relatedProducts'))->with([
            'breadcrumbs' => [
                ['title' => trans('site/site.shop'), 'url' => route('shop.index')],
                ['title' => $product->name]
            ]
        ]);
    }

    public function unlockClientNumber(Request $request, $productId)
    {
        try {
            $request->validate([
                'client_password' => 'required',
            ]);

            $secret = env('CLIENT_NUMBER_PASSWORD', '217121');

            $product = Product::find($productId);
            if (!$product) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'المنتج غير موجود'
                    ], 404);
                }
                return back()->withErrors(['error' => 'المنتج غير موجود']);
            }

            $inputPassword = trim((string)$request->input('client_password'));
            $envSecret = trim((string)$secret);

            if ($inputPassword !== $envSecret) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'كلمة السر غير صحيحة'
                    ], 401);
                }
                return back()->with('client_unlock_error', 'كلمة السر غير صحيحة');
            }

            session()->put('unlocked_client_' . $product->id, true);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'client_number' => $product->client_number ?? '—'
                ]);
            }

            return back()->with('client_unlock_success', 'تم فتح رقم العميل بنجاح');

        } catch (\Throwable $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء معالجة الطلب',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => 'حدث خطأ: ' . $e->getMessage()]);
        }
    }
}
