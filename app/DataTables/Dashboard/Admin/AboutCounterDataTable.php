<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\AboutCounter;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class AboutCounterDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new AboutCounter);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (AboutCounter $aboutCounter) {
                return view('dashboard.admin.aboutCounters.btn.actions', compact('aboutCounter'));
            })
            ->editColumn('created_at', function (AboutCounter $aboutCounter) {
                return $this->formatBadge($this->formatDate($aboutCounter->created_at));
            })
            ->editColumn('updated_at', function (AboutCounter $aboutCounter) {
                return $this->formatBadge($this->formatDate($aboutCounter->updated_at));
            })
            ->rawColumns(['action', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        return AboutCounter::latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#', 'orderable' => false, 'searchable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/admin.name')],
            ['name' => 'description', 'data' => 'description', 'title' => 'الوصف', 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at'), 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}