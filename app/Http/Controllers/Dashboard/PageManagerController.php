<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\PageDataTable;
use App\Services\Contracts\PageInterface;
class PageManagerController extends Controller {
    public function __construct(protected PageDataTable $pageDataTable, protected PageInterface $pageInterface) {
        $this->pageInterface = $pageInterface;
        $this->pageDataTable = $pageDataTable;
    }

    public function index(PageDataTable $pageDataTable) {
        return $this->pageInterface->index($this->pageDataTable);
    }

    public function createGroup() {
        return $this->pageInterface->createGroup();
    }
}