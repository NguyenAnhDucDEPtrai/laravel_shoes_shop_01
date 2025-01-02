<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'size',
        'status',
    ];

    public function shoes()
    {
        return $this->belongsToMany(Shoe::class, 'shoe_sizes');
    }
}
