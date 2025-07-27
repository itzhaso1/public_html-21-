<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\General\OrderDataTable;
use App\Services\Contracts\OrderInterface;
use App\Models\Order;
class OrderController extends Controller {
    public function index(OrderDataTable $dataTable) {
        return $dataTable->render('dashboard.general.orders.index', ['pageTitle' => 'الطلبات']);
    }
}