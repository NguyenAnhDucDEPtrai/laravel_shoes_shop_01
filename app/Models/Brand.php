<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['brand_name', 'status', 'image'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
