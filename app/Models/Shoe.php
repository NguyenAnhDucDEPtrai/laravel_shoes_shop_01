<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = ['shoe_name', 'price', 'description', 'quantity', 'status'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'shoe_categories');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'shoe_sizes');
    }

    public function images()
    {
        return $this->hasMany(ShoeImage::class);
    }
}
