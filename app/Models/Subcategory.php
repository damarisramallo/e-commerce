<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category_id'
        
    ];

    //relación uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relación uno a muchos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
