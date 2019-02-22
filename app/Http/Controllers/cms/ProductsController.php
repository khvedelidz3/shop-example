<?php

namespace App\Http\Controllers\cms;

use App\Attribute;
use App\Category;
use App\Image;
use App\Product;
use App\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        if (! is_null(\request('search'))) {
            $terms = explode(' ', \request('search'));
            $columns = ['id', 'name'];

            $query = null;

            foreach ($terms as $term) {
                foreach ($columns as $column) {
                    if (is_null($query)) {
                        $query = Product::where($column, 'LIKE', '%' . $term . '%');
                    } else {
                        $query->orWhere($column, 'LIKE', '%' . $term . '%');
                    }
                }
            }
            $products = $query->with('categories')->paginate();
        } else {
            $products = Product::with('categories')->paginate();
        }

        return view('cms.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::query()
            ->where('parent_id', '=', null)
            ->get();
        $sizes = Size::all();

        return view('cms.products.create', [
            'categories' => $categories,
            'sizes'      => $sizes
        ]);
    }

    public function show($id)
    {
        $product = Product::with(['categories.parent', 'attributes'])->findOrFail($id);
        $currentCategory = $product->categories;

        $categories = Category::query()
            ->where('parent_id', '=', null)
            ->with('children')
            ->get();

        $sizes = Size::all();

        return view('cms.products.update', [
            'categories'      => $categories,
            'sizes'           => $sizes,
            'product'         => $product,
            'currentCategory' => $currentCategory
        ]);
    }

    public function update($id)
    {
        foreach (\request()->file('productImg') as $index => $file) {
            if (empty($file)) {
                continue;
            }
            $ext = $file->extension();
            Image::query()->findOrFail($index)->update([
                'ext' => $ext
            ]);

            \File::delete('storage/' . floor($index / 1000) . '/' . $index . $ext);
            \Storage::putFileAs(
                "public/" . floor($index / 1000),
                new File($file),
                $index . '.' . $ext
            );
        }

        Product::query()->findOrFail($id)->update([
            'name'        => \request('productName'),
            'price'       => \request('productPrice'),
            'description' => \request('productDescription'),
            'category_id' => \request('productCategory'),
        ]);


        Attribute::query()->where('product_id', '=', $id)->delete();

        foreach (\request('product') as $attribute) {
            if (is_null($attribute['quantity'])) {
                continue;
            }

            Attribute::query()->where('product_id', '=', $id)
                ->create([
                    'product_id' => $id,
                    'size'       => $attribute['size'],
                    'quantity'   => $attribute['quantity']
                ]);
        }

        return redirect('/admin/products');
    }

    public function store(Request $request)
    {

        $request->validate([
            'productName'        => 'required',
            'productPrice'       => 'required',
            'productDescription' => 'required',
            'productCategory'    => 'required',
        ]);

        $product = Product::query()->create([
            'name'        => \request('productName'),
            'price'       => \request('productPrice'),
            'description' => \request('productDescription'),
            'category_id' => \request('productCategory'),
        ]);

        foreach (\request()->file('productImg') as $file) {
            $ext = $file->extension();
            $img = Image::query()->create([
                'product_id' => $product->id,
                'ext'        => $ext
            ]);
            \Storage::putFileAs(
                "public/" . floor($img->id / 1000),
                new File($file),
                $img->id . '.' . $ext
            );
        }

        $productId = $product->id;
        foreach (\request('product') as $attribute) {
            if (is_null($attribute['quantity'])) {
                continue;
            }

            Attribute::query()->create([
                'product_id' => $productId,
                'size'       => $attribute['size'],
                'quantity'   => $attribute['quantity']
            ])->save();
        }

        return redirect('/admin/products');
    }

    public function delete($id)
    {
        Product::query()->findOrFail($id)->delete();

        Attribute::query()->where('product_id', '=', $id)->delete();

        $images = Image::query()->where('product_id', '=', $id)->get();

        foreach ($images as $img) {
            $ext = $img->ext;
            \File::delete('storage/' . floor($img->id / 1000) . '/' . $img->id . '.' . $ext);
        }

        Image::query()->where('product_id', '=', $id)->delete();

        return redirect('/admin/products');
    }
}
