<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	public function index(Category $category)
	{
		if(count($category->children) > 0){
			$products = [];

			$parent = $category->products;
			$children = $category->children;

			foreach($parent as $product){
				$products[] = $product;
			}

			foreach($children as $child){
				$products[] = $child->products;	
			}

			$products = array_flatten($products);

			return view('index')->with('products', $products);

		} else{
			$products = $category->products;

			return view('index')->with('products', $products); 
		}
	}
}
