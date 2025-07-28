<?php

namespace App\Services\Contracts;

use App\DataTables\Dashboard\Admin\PackageDataTable;
use Illuminate\Http\Request;
use App\Models\Page;
use App\DataTables\Dashboard\Admin\PageDataTable;
interface PageInterface {
    public function index(PageDataTable $pageDataTable);
    public function createGroup();
}