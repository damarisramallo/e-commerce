<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'family_id'
        
    ];

    //relación uno a muchos inversa
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    //relación uno a muchos
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);  
    }
}
