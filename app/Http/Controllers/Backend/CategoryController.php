<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::getNestedList('title', null, Category::LIST_INDENT);
//        dd($data['tree_categories']);
        return view('backend.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = [0 => 'Gốc'] + Category::getNestedList('title', 'id', Category::LIST_INDENT);
        return view('backend.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_category = new Category();
        $new_category->title = $request->get('title');
        $new_category->slug = str_slug($request->get('slug', $request->get('title')));
        $new_category->description = $request->get('description');
        if ($request->get('parent_id') < 1){
            $new_category->parent_id = null;
        }else{
            $new_category->parent_id = $request->get('parent_id');
        }
        if ($new_category->save()){
            return redirect()->route('admin.category.index')
                ->withFlashSuccess('Tạo danh mục thành công');
        }else{
            return back();
        }

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
        $data = [];
        $data['category'] = Category::find($id);
        $data['categories'] = [0 => 'Gốc'] + Category::getNestedList('title', 'id', Category::LIST_INDENT);
        return view('backend.categories.edit', $data);
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
        $category = Category::find($id);
        if (!empty($request->get('slug'))){
            $category->slug = $request->get('slug');
        }else{
            $category->slug = $request->get('title');
        }
        $category->title = $request->get('title');

        $category->description = $request->get('description');
        if ($request->get('parent_id') < 1){
            $category->parent_id = null;
        }else{
            $category->parent_id = $request->get('parent_id');
        }
        if ($category->save()){
            return redirect()->route('admin.category.index')
                ->withFlashSuccess('Cập nhật danh mục thành công');
        }else{
            return redirect()->route('admin.category.index')
                ->withFlashSuccess('Cập nhật danh mục không thành công');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var $category Category*/
        $category = Category::find($id);
//        $category->has
        $category->posts()->detach();
        if ($category->delete()){
            return redirect()->route('admin.category.index')
                ->withFlashSuccess('Xoá thành công');
        }
    }
}
