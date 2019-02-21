<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['product_id', 'size', 'quantity'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products');
    }
}
