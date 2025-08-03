<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsTranslation extends Model
{
    protected $table = 'contactus_translations';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'content_title',
        'content_description'
    ];
}