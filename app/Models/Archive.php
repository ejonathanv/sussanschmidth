<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $table = 'archives';

    protected $fillable = [
        'archiveid',
        'title',
        'description',
        'image',
        'category',
        'format',
        'status',
        'digital_info',
        'location',
        'year',
        'height',
        'width',
        'slug',
        'length',
    ];
}
