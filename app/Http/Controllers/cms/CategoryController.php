<?php

namespace App\Http\Controllers\cms;

use App\Category;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('cms.category.index', compact('categories'));
    }


    public function show($id)
    {
        $currentCategory = Category::with('parent')
            ->findOrFail($id);

        $categories = Category::query()
            ->where('parent_id', '=', null)
            ->where('id', '!=', $id)
            ->get();

        return view('cms.category.update', [
            'currentCategory' => $currentCategory,
            'categories'      => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::query()->where('parent_id', '=', null)->get();

        return view('cms.category.create', compact('categories'));
    }

    public function update($id)
    {
        $category = Category::query()
            ->findOrFail($id)
            ->update([
                'name'      => \request('categoryName'),
                'slug'      => \request('slugName'),
                'parent_id' => \request('parentCategory')
            ]);

        return redirect('/admin/categories');
    }

    public function store()
    {
        Category::query()
            ->create([
                'name'      => \request('categoryName'),
                'slug'      => \request('slugName'),
                'parent_id' => empty(\request('parentCategory')) ? null : \request('parentCategory'),
            ]);

        return redirect('/admin/categories');
    }

    public function delete($id)
    {
        $category = Category::query()->findOrFail($id);

        if (count($category->children)) {
            return back()->withErrors(['error' => "You can't delete category while it has sub category"]);
        }

        $category->delete();
        return redirect('/admin/categories');
    }
}
