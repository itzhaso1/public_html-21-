<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\UploadMedia2;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class About extends Model implements TranslatableContract {
    use HasFactory, UploadMedia2, Translatable;

    public $translatedAttributes = [
        'title',
        'description',
        'short_description',
        'content_title',
        'content_description',
        'content_note'
    ];

    protected $fillable = [];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}