<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
    use HasFactory;
    protected $fillable = ['user_id', 'status', 'number', 'payment_status', 'payment_type', 'total_price', 'coupon_id'];
    public function user() {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Guest Customer'
        ]);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }


    public function products() {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id','product_id', 'id', 'id')
        ->using(OrderItem::class)
        ->withPivot([
            'product_name',
            'product_price',
            'quantity',
            'options'
        ]);
    }

    public function addresses() {
        return $this->hasMany(OrderAddress::class);
    }

    protected static function booted() {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }
    public static function getNextOrderNumber() {
        $number = Order::whereYear('created_at', date('Y'))->max('number');
        if($number) {
            return $number + 1;
        }
        return date('Y') . '0001';
    }
}