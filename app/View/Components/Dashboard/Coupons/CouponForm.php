<?php

namespace App\View\Components\Dashboard\Coupons;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Coupon;
use App\View\Components\BaseForm;
class CouponForm extends BaseForm {
    public $products;
    public $categories;

    public function __construct(
        $action = '',
        $method = 'POST',
        $enctype = null,
        $products = [],
        $categories = []
    ) {
        parent::__construct($action, $method, $enctype);
        $this->products = $products;
        $this->categories = $categories;
    }

    public function render(): View|Closure|string {
        return view('components.dashboard.coupons.coupon-form');
    }
}
