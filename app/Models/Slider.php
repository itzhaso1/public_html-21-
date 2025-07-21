<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UploadMedia2;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Slider extends Model implements TranslatableContract
{
    use HasFactory, UploadMedia2, Translatable;
    protected $table = 'sliders';
    protected $with = ['translations'];
    public $translatedAttributes = ['name', 'description'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
