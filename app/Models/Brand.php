<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UploadMedia2;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Brand extends Model implements TranslatableContract
{
    use HasFactory, UploadMedia2, Translatable;
    protected $table = 'brands';
    protected $fillable = [
        'category_id'
    ];
    public $translatedAttributes = ['name', 'description'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
