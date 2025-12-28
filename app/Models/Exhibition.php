<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $table = 'exhibitions';

    protected $fillable = [
        'year',
        'title',
        'subtitle',
        'description',
        'description_two',
        'place',
        'location',
        'category',
    ];
}

