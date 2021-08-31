<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_Product extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'color_product';

    protected $fillable = [
        'product_id',
        'color_id',
        'image'
    ];

    protected $casts = [
        'image_gallery' => 'array'
    ];

}
