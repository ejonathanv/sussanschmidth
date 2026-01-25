<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmallFormat extends Model
{
    use HasFactory;

    protected $table = 'small_formats';

    protected $fillable = [
        'smallformatid',
        'title',
        'description',
        'image',
        'category',
        'format',
        'status',
        'location',
        'year',
        'height',
        'width',
        'slug',
        'length',
        'is_available',
        'is_digital_print',
    ];
}
