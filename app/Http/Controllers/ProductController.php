<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            $product->care = $data['care'];
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
    public function editProduct(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            $newImage = $data['currentImage'];

            if ($request->hasFile('image')) {
                $currentImage =  $data['currentImage'];
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = pathinfo($image_tmp->getClientOriginalName(), PATHINFO_FILENAME) . rand(111, 9999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;

                    try {
                        #resize
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                        $newImage = $filename;

                        $currentLargePath = public_path('images/backend_images/products/large/' . $currentImage);
                        $currentMediumPath = public_path('images/backend_images/products/medium/' . $currentImage);
                        $currentSmallPath = public_path('images/backend_images/products/small/' . $currentImage);

                        if (File::exists($currentLargePath)) {
                            File::delete($currentLargePath);
                        }
                        if (File::exists($currentMediumPath)) {
                            File::delete($currentMediumPath);
                        }
                        if (File::exists($currentSmallPath)) {
                            File::delete($currentSmallPath);
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                        dd($th);
                    }
                }
            }

            Product::where(['id' => $id])->update([
                'category_id' => $data['category_id'],
                'product_name' => $data['product_name'],
                'product_code' => $data['product_code'],
                'product_color' => $data['product_color'],
                'description' => $data['description'],
                'care' => $data['care'],
                'price' => $data['price'],
                'image' => $newImage,
            ]);
            return redirect('/admin/view-products')->with('flash_message_success', 'Product' . $id . ' updated');
        }






        $productDetails =  Product::where(['id' => $id])->first();

        $categories  = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value ='' selected disable>Select</option>";
        foreach ($categories as $cat) {

            $selected = ($cat->id == $productDetails->category_id) ? 'selected' : '';

            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
            $sub_categories  = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $selected = ($sub_cat->id == $productDetails->category_id) ? 'selected' : '';

                $categories_dropdown .= "<option value='" . $sub_cat->id . "' " . $selected . ">&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin.products.edit_product')->with(compact('productDetails', 'categories_dropdown'));
    }
    public function deleteProductImage(Request $request, $id = null)
    {

        $productImage = Product::where(['id' => $id])->first();

        $largePath = public_path('/images/backend_images/products/large/' . $productImage->image);
        $mediumPath = public_path('/images/backend_images/products/medium/' . $productImage->image);
        $smallPath = public_path('/images/backend_images/products/small/' . $productImage->image);

        if (File::exists($largePath)) {
            File::delete($largePath);
        }
        if (File::exists($mediumPath)) {
            File::delete($mediumPath);
        }
        if (File::exists($smallPath)) {
            File::delete($smallPath);
        }

        Product::where(['id' => $id])->update(['image' => '']);
        return redirect()->back()->with('flash_message_success', 'removed product ' . $id . " 's image");
    }
    public function deleteProduct(Request $request, $id = null)
    {
        Product::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'removed product ' . $id);
    }
    public function addAttributes(Request $request, $id = null)
    {
        $productDetails = Product::with('attributes')->where(['id' => $id])->firstOrFail();
        // dd($productDetails);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    $countSKU = ProductsAttribute::where(['sku' => $value])->count();
                    if ($countSKU > 0) {
                        return redirect('/admin/add-attributes/' . $id)->with('flash_message_error', 'SKU ' . $value . 'has already existed!');
                    }

                    $countSize = ProductsAttribute::where([
                        'product_id' => $id,
                        'size' => $data['size'][$key]
                    ])->count();

                    if ($countSize > 0) {
                        return redirect('/admin/add-attributes/' . $id)->with('flash_message_error', $data['size'][$key] . ' has already existed!');
                    }
                    $attribute = new ProductsAttribute();
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect()->back()->with('flash_message_success', 'added attributes');
        }

        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }
    public function editAttributes(Request $request, $id = null)
    {
        // $productDetails = Product::with('attributes')->where(['id' => $id])->firstOrFail();
        // dd($productDetails);
        if ($request->isMethod('post')) {
            $data = $request->all();
            dd($data);
            foreach ($data['idAttr'] as $key => $attr) {
                ProductsAttribute::where([
                    'id', $data['idAttr'][$key]
                ])->update([
                    'price' => $data['price'][$key],
                    'stock' => $data['stock'][$key]
                ]);
            }
            return redirect()->back()->with('flash_message_success', 'updated attributes');
        }
    }
    public function addImages(Request $request, $id = null)
    {
        $productDetails = Product::with('attributes')->where(['id' => $id])->firstOrFail();

        if ($request->isMethod('post')) {
            $data = $request->all();


            if ($request->hasFile('image')) {
                $files = $request->file('image');


                foreach ($files as $file) {
                    # code...
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . rand(111, 9999) . '.' . $extension;


                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;

                    #resize
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);


                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }

            return redirect()->back()->with('flash_message_success', 'Product images has been added successfully.');
        }
        $productsImages = ProductsImage::where(['product_id' => $id])->get();

        return view('admin.products.add_images')->with(compact('productDetails', 'productsImages'));
    }
    public function deleteProductAltImage(Request $request, $id = null)
    {
        $productImage = ProductsImage::where(['id' => $id])->first();

        $largePath = public_path('/images/backend_images/products/large/' . $productImage->image);
        $mediumPath = public_path('/images/backend_images/products/medium/' . $productImage->image);
        $smallPath = public_path('/images/backend_images/products/small/' . $productImage->image);

        if (File::exists($largePath)) {
            File::delete($largePath);
        }
        if (File::exists($mediumPath)) {
            File::delete($mediumPath);
        }
        if (File::exists($smallPath)) {
            File::delete($smallPath);
        }

        ProductsImage::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'removed product  alternative image');
    }
    public function deleteAttribute(Request $request, $id = null)
    {
        ProductsAttribute::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'removed product attribute ' . $id);
    }

    public function products(Request $request, $url = null)
    {
        $categories = Category::with('categories')->where(['parent_id' => 0, 'status' => 1])->get();

        $category = Category::where(['url' => $url, 'status' => 1])->firstOrFail();

        // dd($products);
        if ($category->parent_id != 0) {
            // if url is sub category
            $products = Product::where(['category_id' => $category->id])->get();
        } else {
            // if url is main category
            $subCategories = Category::where(['parent_id' => $category->id, 'status' => 1])->get()->toArray();
            //all id of parent and child
            $subCatIDs = array_map(function ($cat) {

                return $cat['id'];
            }, $subCategories);

            $catIDs = array_merge(array($category->id), $subCatIDs);

            $products = Product::whereIn('category_id', $catIDs)->get();
        }
        return view('products.product_list')->with(compact('category', 'products', 'categories'));
    }
    public function productDetails(Request $request, $id = null)
    {
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        $productAltImages = ProductsImage::where(['product_id' => $id])->get();

        $mainImage = new ProductsImage(['product_id' => $id, 'image' => $productDetails->image]);
        $productAltImages->prepend($mainImage);

        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        // dd($total_stock);
        // dd($productAltImages);
        // dd($productAltImages);
        return view('products.product_details')->with(compact('productDetails', 'categories', 'productAltImages', 'total_stock'));
    }
    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        $optionArray = explode("-", $data['sizeId']);
        $productAttribute = ProductsAttribute::where([
            'product_id' => $optionArray[0],
            'size' => $optionArray[1],

        ])->first();
        return $productAttribute->price;
        // dd($productAttribute);
    }
}
