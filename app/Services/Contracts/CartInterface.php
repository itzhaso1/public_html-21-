<?php

namespace App\Services\Contracts;
use Illuminate\Http\Request;
use App\Models\{Cart,Product, Coupon};
use Illuminate\Support\Collection;
interface CartInterface {
    public function get() : Collection;
    public function add(Product $product, $quantity = 1);
    public function update($id, $quantity);
    public function delete($id);
    public function empty();
    public function total(): float;
    public function applyCoupon(Coupon $coupon);
}