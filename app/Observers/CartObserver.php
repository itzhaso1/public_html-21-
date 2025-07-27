<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Str;
class CartObserver {
    public function creating(Cart $cart): void {
        $cart->id = Str::uuid();
        $cart->cookie_id = $cart->getCookieId();
    }
}
