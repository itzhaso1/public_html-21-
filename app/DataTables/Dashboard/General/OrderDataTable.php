<?php

namespace App\DataTables\Dashboard\General;

use App\DataTables\Base\BaseDataTable;
use App\Models\{Order, Setting};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;
use Illuminate\Support\Facades\Cache;
use App\Enums\Order\OrderStatus;
class   OrderDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Order);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', function (Order $order) {
                return view('dashboard.general.orders.btn.actions', compact('order'));
            })
            ->addColumn('user_name', function (Order $order) {
                return $order->user->name;
            })
            ->editColumn('status', function (Order $order) {
                $statuses = [
                    'pending' => ['text' => 'قيد الانتظار', 'color' => 'secondary'],
                    'processing' => ['text' => 'جارِ التجهيز', 'color' => 'info'],
                    'delivering' => ['text' => 'جارِ التوصيل', 'color' => 'warning'],
                    'completed' => ['text' => 'مكتمل', 'color' => 'success'],
                ];
                $options = '';
                foreach ($statuses as $value => $data) {
                    $selected = $order->status === $value ? 'selected' : '';
                    $options .= "<option value='{$value}' {$selected}>{$data['text']}</option>";
                }
                $color = $statuses[$order->status]['color'] ?? 'secondary';
                return "<select class='form-control form-select order-status-change bg-{$color} text-dark' data-id='{$order->id}' style='min-width: 140px'>
                    {$options}
                </select>";
            })

            ->editColumn('payment_status', function (Order $order) {
                $statuses = [
                    'pending' => ['text' => 'قيد الانتظار', 'color' => 'secondary'],
                    'paid' => ['text' => 'مدفوع', 'color' => 'success'],
                    'failed' => ['text' => 'فشل الدفع', 'color' => 'danger'],
                ];

                $options = '';
                foreach ($statuses as $value => $data) {
                    $selected = $order->payment_status === $value ? 'selected' : '';
                    $options .= "<option value='{$value}' {$selected}>{$data['text']}</option>";
                }

                $color = $statuses[$order->payment_status]['color'] ?? 'secondary';

                return "<select class='form-control form-select payment-status-change bg-{$color} text-dark' style='min-width: 140px;' data-id='{$order->id}'>
                    {$options}
                </select>";
            })


            ->editColumn('payment_type', function (Order $order) {
                return match ($order->payment_type) {
                    'cash_on_delivery' => $this->formatColoredBadge('الدفع عند الاستلام', 'primary'),
                    'payment_method' => $this->formatColoredBadge('أونلاين', 'info'),
                    default => $order->payment_type,
                };
            })

            ->addColumn('product_count', function (Order $order) {
                $count = $order->products->count();
                if ($count > 0) {
                    return '<span class="badge bg-info">' . $count . ' منتج</span>';
                }
                return '<span class="badge bg-danger">لا يوجد</span>';
            })

            ->addColumn('coupon_code', function (Order $order) {
                if ($order->coupon?->code) {
                    return '<span class="badge bg-success">' . $order->coupon->code . '</span>';
                }
                return '<span class="badge bg-warning">لا يوجد كوبون</span>';
            })


            ->editColumn('created_at', function (Order $order) {
                return $this->formatBadge($this->formatDate($order->created_at));
            })
            ->editColumn('updated_at', function (Order $order) {
                return $this->formatBadge($this->formatDate($order->updated_at));
            })
            ->rawColumns(['actions', 'coupon_code', 'product_count', 'created_at', 'updated_at', 'status', 'payment_status', 'payment_type']);
    }
    
    public function query(): QueryBuilder {
        return Order::with(['user', 'products', 'coupon'])->latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'number', 'data' => 'number', 'title' => 'رقم الطلب'],
            ['data' => 'user_name', 'title' => 'العميل', 'orderable' => false, 'searchable' => false],
            ['data' => 'product_count', 'title' => 'عدد المنتجات'],
            ['data' => 'coupon_code', 'title' => 'الكوبون', 'orderable' => false, 'searchable' => false],
            ['data' => 'status', 'title' => 'الحالة', 'searchable' => false],
            ['data' => 'payment_status', 'title' => 'حالة الدفع' ,'searchable' => false],
            ['data' => 'payment_type', 'title' => 'وسيلة الدفع', 'searchable' => false],
            ['data' => 'total_price', 'title' => 'الإجمالي', 'searchable' => false],
            ['data' => 'created_at', 'title' => 'تاريخ الإنشاء'],
            ['data' => 'actions', 'title' => 'التحكم', 'orderable' => false, 'searchable' => false],
        ];
    }
}