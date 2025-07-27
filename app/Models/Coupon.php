<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    use HasFactory;
    protected $fillable = ['code', 'type', 'status', 'value', 'min_spend', 'max_spend', 'starts_at', 'expires_at'];

    public function products() {
        return $this->belongsToMany(Product::class, 'coupon_product');
    }

    public function excludedProducts() {
        return $this->belongsToMany(Product::class, 'coupon_excluded_product');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'coupon_category');
    }

    public function excludedCategories() {
        return $this->belongsToMany(Category::class, 'coupon_excluded_category');
    }
}
