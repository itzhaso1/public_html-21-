<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller {
    public function __invoke(Request $request) {
        $filter = $request->query('filter', 'daily');
        return view('dashboard.admin.dashboard', [
            'PageTitle' => trans('dashboard/header.main_dashboard'),
            //'ordersPerDay' => $ordersData,
            //'currentFilter' => $filter,
        ]);
    }
}
