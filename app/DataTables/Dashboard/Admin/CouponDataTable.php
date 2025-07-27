<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\{Coupon};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class CouponDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request) {
        parent::__construct(new Coupon);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Coupon $coupon) {
                return view('dashboard.admin.coupons.btn.actions', compact('coupon'));
            })
            ->editColumn('created_at', function (Coupon $coupon) {
                return $this->formatBadge($this->formatDate($coupon->created_at));
            })
            ->editColumn('updated_at', function (Coupon $coupon) {
                return $this->formatBadge($this->formatDate($coupon->updated_at));
            })
            ->addColumn('period', function (Coupon $coupon) {
                return '<div>
                            <strong>من:</strong> ' . $coupon->starts_at . '<br>
                            <strong>إلى:</strong> ' . $coupon->expires_at . '
                        </div>';
            })
            ->editColumn('status', function (Coupon $coupon) {
                return $coupon->status === 'active'
                    ? '<span class="badge bg-success">مفعل</span>'
                    : '<span class="badge bg-danger">غير مفعل</span>';
            })
            ->addColumn('type_value', function (Coupon $coupon) {
                if ($coupon->type === 'percentage') {
                    return '<span class="badge bg-info">نسبة: ' . $coupon->value . '%</span>';
                }

                if ($coupon->type === 'fixed') {
                    return '<span class="badge bg-primary">خصم ثابت: ' . number_format($coupon->value, 2) . ' ج.م</span>';
                }

                return '-';
            })
            ->addColumn('spend_limits', function (Coupon $coupon) {
                return '<small>الحد الأدنى: ' . $coupon->min_spend . '<br>الحد الأقصى: ' . $coupon->max_spend . '</small>';
            })
            ->rawColumns(['action', 'status', 'created_at', 'updated_at', 'period', 'type_value', 'spend_limits']);
    }

    public function query(): QueryBuilder {
        return Coupon::latest();
    }

    public function getColumns(): array {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false],
            ['name' => 'code', 'data' => 'code', 'title' => trans('dashboard/admin.name')],
            ['name' => 'period', 'data' => 'period', 'title' => 'الفترة', 'orderable' => false, 'searchable' => false],
            ['name' => 'status', 'data' => 'status', 'title' => 'الحاله', 'orderable' => false, 'searchable' => false],
            ['name' => 'type_value', 'data' => 'type_value', 'title' => 'النوع والقيمة', 'orderable' => false, 'searchable' => false],
            ['name' => 'spend_limits', 'data' => 'spend_limits', 'title' => 'حد الإنفاق', 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}