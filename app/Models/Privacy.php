<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class Privacy extends Model implements TranslatableContract{
    use HasFactory, Translatable;
    protected $fillable = [];
    public $translatedAttributes = ['title', 'description'];
    protected $with = ['translations'];
}