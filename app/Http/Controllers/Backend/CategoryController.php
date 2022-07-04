<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index', [
            'categories' => Category::with('parent_info')->get(),
            'parent_categories' => Category::where('is_parent', '!=', null)->where('status', 'active')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|max:25|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'parent_id' => $request->parent_id ?? null,
            'is_parent' => $request->is_parent ?? null,
            'status' => 'active',
        ]);

        Alert::alert('Berhasil', 'Data kategori berhasil ditambahkan', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', [
            'cat' => $category,
            'parent_categories' => Category::where('is_parent', '!=', null)->where('status', 'active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'parent_id' => $request->parent_id ?? null,
            'is_parent' => $request->is_parent ?? null,
            'status' => 'active',
        ]);

        Alert::success('Berhasil', 'Data kategori berhasil diubah', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // update check kategori yang masih mempunyai produk jangan dihapus
        
        $category = Category::findOrFail($id);
        $category->delete();
        return true;
    }
}
