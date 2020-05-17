<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addProduct(Request $request)
    {


        if ($request->isMethod('post')) {
            $data = $request->all();


            if (empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_error', 'missing category');
            }

            $product = new Product();
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->description = $data['description'];
            $product->image = '';
            $product->price = $data['price'];

            $product->save();
            return redirect()->back()->with('flash_message_success', 'product added successfully');
        }

        $categories  = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value ='' selected disable>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories  = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {

                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }
}
