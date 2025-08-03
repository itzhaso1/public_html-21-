<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
class AboutCounter extends Model implements TranslatableContract {
    use HasFactory,Translatable;
    protected $with = ['translations'];
    public $translatedAttributes = ['name', 'description'];
}