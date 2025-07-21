<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Section;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class SectionDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Section);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('details', function (Section $section) {
                $categoryNames = $section->categories->pluck('name')->implode(' - ');
                $productCount = $section->products()->count();
                $order = $section->order ?? '—';

                return '
                <div class="d-flex flex-column gap-1">
                    <span class="badge bg-primary">التصنيفات: ' . e($categoryNames) . '</span>
                    <span class="badge bg-success">عدد المنتجات: ' . $productCount . '</span>
                    <span class="badge bg-warning">الترتيب: ' . $order . '</span>
                </div>
            ';
            })
            ->addColumn('action', function (Section $section) {
                return view('dashboard.admin.sections.btn.actions', compact('section'));
            })
            ->editColumn('created_at', function (Section $section) {
                return $this->formatBadge($this->formatDate($section->created_at));
            })
            ->editColumn('updated_at', function (Section $section) {
                return $this->formatBadge($this->formatDate($section->updated_at));
            })
            ->rawColumns(['details','action', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
            return Section::with(['categories', 'translations', 'products.translations', 'products.media'])->latest();

    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/admin.name')],
            ['name' => 'description', 'data' => 'description', 'title' => 'الوصف', 'orderable' => false, 'searchable' => false],
            ['name' => 'details', 'data' => 'details', 'title' => 'تفاصيل', 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
