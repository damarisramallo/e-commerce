<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'image_path',
        'product_id',
    ];

    //relación uno a muchos inversa
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //relación muchos a muchos
    public function features()
    {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
