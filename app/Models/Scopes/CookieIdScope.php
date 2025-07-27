<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CookieIdScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        $builder->where('cookie_id', '=', request()->cookie('cart_id'));
    }
}