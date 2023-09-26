<?php

namespace Fieroo\Furnitures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Fieroo\Furnitures\Models\FurnishingTranslation;
use Fieroo\Furnitures\Models\FurnishingStandType;

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

    public function variants()
    {
        return $this->hasMany(self::class, 'variant_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'variant_id');
    }

    public function translations()
    {
        return $this->hasMany(FurnishingTranslation::class);
    }

    public function stands()
    {
        return $this->hasMany(FurnishingStandType::class);
    }
}
