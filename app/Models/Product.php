<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'subcategory_id',
    ];

    //relación uno a muchos inversa
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    //relación uno a muchos
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    //relación muchos a muchos
    public function options()
    {
        return $this->belongsToMany(Option::class)
            ->withPivot('value') // Agrega el campo 'value' a la tabla pivote
            ->withTimestamps(); // Agrega campos de timestamps a la tabla pivote
    }
}
