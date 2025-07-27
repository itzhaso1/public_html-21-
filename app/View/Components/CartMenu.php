<?php

namespace App\View\Components;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Facades\Cart;
class CartMenu extends Component {
    public $items;
    public $total;
    public function __construct() {
        $this->items = Cart::get();
        $this->total = Cart::total();
    }

    public function render(): View|Closure|string {
        return view('components.cart-menu');
    }
}
