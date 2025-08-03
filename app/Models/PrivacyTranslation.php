<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyTranslation extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
    protected $casts = [
        'description' => 'array', // important for bullet points
    ];
}