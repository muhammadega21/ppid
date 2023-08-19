<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin', User::class);
        return view('dashboard.category.index', [
            'title' => 'Post Category',
            'category' => Category::all()->sortBy('name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('admin', User::class);
        return view('dashboard.category.create', [
            'title' => 'Create Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin', User::class);
        $request->validate([
            'name' => 'required|max:10|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ], [

            'name.required' => 'Nama Category Tidak Boleh Kosong!',
            'name.unique' => 'Category Sudah Ada!',
            'name.max' => 'Max 10 Character!',

            'slug.required' => 'Slug Tidak Boleh Kosong!',
            'slug.unique' => 'Slug Sudah Ada!',
        ]);

        Category::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
        ]);

        return redirect('/dashboard/category')->with('success', 'Berhasil Menambah Category Baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('admin', User::class);
        return view('dashboard.category.edit', [
            'title' => "Edit Post",
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('admin', User::class);
        $validasi = [];

        if ($request->name != $category->name) {
            $validasi['name'] = 'required|max:10|unique:categories,name';
        }
        if ($request->slug != $category->slug) {
            $validasi['slug'] = 'required|unique:categories,slug';
        }

        $request->validate(
            $validasi,
            [

                'name.required' => 'Nama Category Tidak Boleh Kosong!',
                'name.unique' => 'Category Sudah Ada!',
                'name.max' => 'Max 10 Character!',

                'slug.required' => 'Slug Tidak Boleh Kosong!',
                'slug.unique' => 'Slug Sudah Ada!',
            ]
        );

        Category::where('id', $category->id)
            ->update([
                'name' => $request['name'],
                'slug' => $request['slug'],
            ]);

        return redirect('/dashboard/category')->with('success', 'Berhasil Update Category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('admin', User::class);
        Category::destroy($category->id);
        return redirect('/dashboard/category')->with('success', 'Berhasil Menghapus Category');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
