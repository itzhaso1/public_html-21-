<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Tag extends Model implements TranslatableContract {
    use HasFactory, Translatable;
    protected $table = 'tags';
    public $translatedAttributes = ['name'];
}
