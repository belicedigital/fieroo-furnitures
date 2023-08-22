<?php

namespace Fieroo\Furnitures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furnishing extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'price',
        'variant_id',
        'is_variant',
        'color',
        'file_path',
        'extra_price'
    ];
}
