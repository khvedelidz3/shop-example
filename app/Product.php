<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $description
 * @property int $quantity
 * @property string $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Product extends Model
{
	protected $fillable = ['name', 'price', 'description', 'category_id', 'img'];

	public function categories() {
	    return $this->hasOne(Category::class, 'id', 'category_id');
	}

	public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
