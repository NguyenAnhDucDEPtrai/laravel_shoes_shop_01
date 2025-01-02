<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'brand_id',
        'status',
    ];
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function shoes()
    {
        return $this->belongsToMany(Shoe::class, 'shoe_categories');
    }
}
