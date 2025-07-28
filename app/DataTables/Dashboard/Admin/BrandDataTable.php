<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class BrandDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Brand);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Brand $brand) {
                return view('dashboard.admin.brands.btn.actions', compact('brand'));
            })
            ->editColumn('created_at', function (Brand $brand) {
                return $this->formatBadge($this->formatDate($brand->created_at));
            })
            ->editColumn('updated_at', function (Brand $brand) {
                return $this->formatBadge($this->formatDate($brand->updated_at));
            })
            ->editColumn('brand', function (Brand $brand) {
                return '<img src="' . $brand->getMediaUrl('brand', $brand, null, 'media', 'brand') . '" class="img-fluid" alt="' . $brand->name . '" style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 5px;"/>';
            })
            ->addColumn('category', function (Brand $brand) {
                return $brand->category?->name ?? '<span class="text-muted">لا يوجد</span>';
            })
            ->rawColumns(['action', 'created_at', 'updated_at', 'brand', 'category']);
    }

    public function query(): QueryBuilder
    {
        return Brand::with(['media', 'category'])->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/admin.name')],
            ['name' => 'brand', 'data' => 'brand', 'title' => 'الصوره', 'orderable' => false, 'searchable' => false],
            ['name' => 'category','data' => 'category','title' => 'التصنيف','orderable' => false,'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}