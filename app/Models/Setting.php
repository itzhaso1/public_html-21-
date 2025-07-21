<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UploadMedia2;

class Setting extends Model
{
    use HasFactory, UploadMedia2;
    protected $table = 'settings';
    protected $fillable = [
        'name',
        'email',
        'description',
        'phone',
        'address',
        'status',
        'currency',
        'loyalty_points',
        'delivery_fees',
        'version'
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}