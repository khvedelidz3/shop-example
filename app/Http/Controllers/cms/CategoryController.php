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
//        $categories = Category::get()->toTree();
        $categories = Category::with('parentCategory')->get();
//        dd($categories);

        return view('cms.category.index', [
            'categories' => $categories
        ]);
    }


    public function show($id)
    {
        $currentCategory = Category::with('parent')
            ->findOrFail($id);


        $nodes = Category::get()->toTree();

        $cats = [];

        $traverse = function ($categories, $prefix = '--') use (&$cats, &$traverse) {
            foreach ($categories as $category) {
                $cats[$category->id] = PHP_EOL . $prefix . ' ' . $category->name;

                $traverse($category->children, $prefix . '--');
            }
        };

        $traverse($nodes);

        return view('cms.category.update', [
            'currentCategory' => $currentCategory,
            'cats'      => $cats
        ]);
    }

    public function create()
    {
        $nodes = Category::get()->toTree();
        $cats = [];

        $traverse = function ($categories, $prefix = '--') use (&$cats, &$traverse) {
            foreach ($categories as $category) {
                $cats[$category->id] = PHP_EOL . $prefix . ' ' . $category->name;

                $traverse($category->children, $prefix . '--');
            }
        };

        $traverse($nodes);


        return view('cms.category.create', [
            'cats' => $cats
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'categoryName' => 'required',
            'slugName'     => 'required|unique:categories,slug,' . $id,
        ]);

        $category = Category::query()
            ->findOrFail($id)
            ->update([
                'name'      => \request('categoryName'),
                'slug'      => \request('slugName'),
                'parent_id' => \request('parentCategory')
            ]);

        return redirect('/admin/categories');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required',
            'slugName'     => 'required|unique:categories,slug',
        ]);


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
