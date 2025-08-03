<?php

namespace App\Http\Controllers\Website\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, Category};
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        $categories = Category::with(['translations', 'media', 'children.translations'])
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->get();
        $data = [
            'total'      => $orders->count(),
            'pending'    => $orders->where('status', 'pending')->count(),
            'processing' => $orders->where('status', 'processing')->count(),
            'delivering' => $orders->where('status', 'delivering')->count(),
            'completed'  => $orders->where('status', 'completed')->count(),
            'canceled'   => $orders->where('status', 'canceled')->count(),
            'refunded'   => $orders->where('status', 'refunded')->count(),
            'pageTitle'  => $user?->name . ' | Dashboard',
        ];
        return view('website.customer.dashboard', compact('data', 'user', 'categories'));
    }

    public function ordersByStatus(Request $request) {
        $status = $request->get('status');
        $query = Order::query()->where('user_id', auth()->id());
        if ($status && $status != 'total') {
            $query->where('status', $status);
        }
        $orders = $query->with(['coupon'])->latest()->paginate(5);

        return response()->json([
            'data' => $orders->items(),
            'links' => (string) $orders->links('pagination::bootstrap-5'),
        ]);
    }

    public function showPartial(Order $order) {
        \Log::info('Order ID:', ['id' => $order->id]);
        $order->load([
            'user',
            'coupon',
            'addresses',
            'products.category',
            'products.brand',
            'products.sections'
        ]);

        $statusColors = [
            'pending'     => ['text' => 'قيد الانتظار', 'color' => 'secondary'],
            'processing'  => ['text' => 'جارِ التجهيز', 'color' => 'info'],
            'delivering'  => ['text' => 'جارِ التوصيل', 'color' => 'warning'],
            'completed'   => ['text' => 'مكتمل', 'color' => 'success'],
        ];

        return response()->json([
            'html' => view('website.customer.orders_details', [
                'order' => $order,
                'statusColors' => $statusColors,
                'pageTitle' => 'تفاصيل الطلب'
            ])->render()
        ]);
    }
}