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

    public function query(): QueryBuilder
    {
        return Order::with(['user', 'products', 'coupon'])->latest();
    }

    public function getColumns(): array
    {
        return [
            ['data' => 'number', 'title' => 'رقم الطلب'],
            ['data' => 'user_name', 'title' => 'العميل'],
            ['data' => 'product_count', 'title' => 'عدد المنتجات'],
            ['data' => 'coupon_code', 'title' => 'الكوبون'],
            ['data' => 'status', 'title' => 'الحالة'],
            ['data' => 'payment_status', 'title' => 'حالة الدفع'],
            ['data' => 'payment_type', 'title' => 'وسيلة الدفع'],
            ['data' => 'total_price', 'title' => 'الإجمالي'],
            ['data' => 'created_at', 'title' => 'تاريخ الإنشاء'],
            ['data' => 'actions', 'title' => 'التحكم', 'orderable' => false, 'searchable' => false],
        ];
    }
}