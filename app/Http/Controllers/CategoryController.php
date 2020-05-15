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
            $newCategory->save();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Category added');
        }
        return view('admin.categories.add_category');
    }
    public function viewCategories()
    {
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }
    public function editCategory(Request $request, $id = null)
    {
        # code...
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

        return view('admin.categories.edit_categories')->with(compact('categoryDetails'));
    }
}
