<?php

namespace Fieroo\Furnitures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnishingStandType extends Model
{
    use HasFactory;

    public $table = 'furnishings_stands_types';

    protected $fillable = [
        'stand_type_id',
        'furnishing_id',
        'is_supplied',
        'min',
        'max',
    ];
}
