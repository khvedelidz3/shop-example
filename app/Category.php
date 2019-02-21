<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

	public function products() {
	    return $this->hasOne(Product::class);
	}

	public function parent()
	{
		return $this->hasOne(Category::class, 'id', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id', 'id');
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}

    public function getParentsNames() {
        if($this->parent) {
            return $this->parent->getParentsNames(). " > " . $this->name;
        } else {
            return $this->name;
        }
    }
}
