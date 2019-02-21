<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['index', 'show']);
	}
	
	public function index()
	{
		$products = Product::orderBy('created_at', 'desc')->get();

		return view('index')->with('products', $products);
	}

	public function show(Product $product)
	{

		if($product->quantity > 5){
			$stockLevel = "In Stock";
		} elseif($product->quantity <= 5 && $product->quantity > 0) {
			$stockLevel = "Low Stock";
		} else {
			$stockLevel = "Not Available";		}

		return view('products.show')->with([
			'stockLevel' => $stockLevel,
			'product' => $product
			]);
	}

	public function create()
	{
		return view('products.create');
	}

	public function store(Request $request)
	{
		$validated = $this->validate($request, [
			'name' => 'required|max:255',
			'description' => 'required',
			'price' => 'required|numeric'
		]);

		Product::create($validated);

		return redirect('/');

	}
}
