<?php

namespace Fieroo\Furnitures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Fieroo\Furnitures\Models\Furnishing;

class FurnishingTranslation extends Model
{
    use HasFactory;

    public $table = 'furnishings_translations';
    public $timestamps = false;

    protected $fillable = [
        'furnishing_id',
        'locale',
        'description',
    ];

    public function furnishing()
    {
        return $this->belongsTo(Furnishing::class);
    }
}
