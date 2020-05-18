<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

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
            if ($request->hasFile('image')) {

                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = pathinfo($image_tmp->getClientOriginalName(), PATHINFO_FILENAME) . rand(111, 9999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;

                    #resize
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    $product->image = $filename;
                }
            }
            $product->price = $data['price'];

            $product->save();
            return redirect('/admin/view-products')->with('flash_message_success', 'product added successfully');
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
    public function viewProducts(Request $request)
    {
        $products = Product::get();

        foreach ($products as $key => $value) {
            $category_name = Category::where(['id' => $value->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with(compact('products'));
    }
}
