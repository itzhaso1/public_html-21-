<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CookieIdScope;
use Illuminate\Support\Facades\{Cookie};
use Illuminate\Support\{Str};
class Cart extends Model {
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    protected static function booted() {
        static::addGlobalScope(new CookieIdScope);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getCookieId() {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30);
        }
        return $cookie_id;
    }
}