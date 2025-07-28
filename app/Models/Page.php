<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use App\Models\Concerns\UploadMedia2;
class Page extends Model implements TranslatableContract {
    use HasFactory, Translatable,UploadMedia2;

    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['slug', 'type', 'status', 'show_in_header', 'show_in_footer', 'footer_group_id'];
    protected $with = ['translations'];
    protected $casts = [
        'status' => 'boolean',
        'show_in_header' => 'boolean',
        'show_in_footer' => 'boolean',
    ];
    public function group() {
        return $this->belongsTo(FooterGroup::class, 'footer_group_id');
    }

    public function media() {
        return $this->morphMany(Media::class, 'mediable');
    }
}
