<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $newCategory = new Category();
            $newCategory->name = $data['category_name'];
            $newCategory->description = $data['description'];
            $newCategory->url = $data['url'];
            $newCategory->parent_id = $data['parent_id'];
            $newCategory->save();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Category added');
        }
        $levels = Category::where(['parent_id' => '0'])->get();

        return view('admin.categories.add_category')->with(compact('levels'));
    }
    public function viewCategories()
    {
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }
    public function editCategory(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            Category::where(['id' => $id])->update([
                'name' => $data['category_name'],
                'description' => $data['description'],
                'url' => $data['url']
            ]);
            return redirect('/admin/view-categories')->with('flash_message_success', 'Category updated');
        }
        $categoryDetails = Category::where(['id' => $id])->first();

        $levels = Category::where(['parent_id' => '0'])->get();
        return view('admin.categories.edit_categories')->with(compact('categoryDetails', 'levels'));
    }
    public function deleteCategory(Request $request, $id = null)
    {
        # code...
        if (!empty($id)) {

            Category::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Category deleted');
        }
        $categoryDetails = Category::where(['id' => $id])->first();

        return view('admin.categories.edit_categories')->with(compact('categoryDetails'));
    }
}
