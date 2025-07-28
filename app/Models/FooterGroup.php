<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class FooterGroup extends Model implements TranslatableContract {
    use HasFactory, Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = ['status'];
    protected $with = ['translations'];
    public function pages() {
        return $this->hasMany(Page::class, 'footer_group_id');
    }
}
