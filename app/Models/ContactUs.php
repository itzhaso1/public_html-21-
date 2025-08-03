<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class ContactUs extends Model implements TranslatableContract {
    use HasFactory, Translatable;
    protected $table = 'contactus';
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'description', 'content_title', 'content_description'];
}