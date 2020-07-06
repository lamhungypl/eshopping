<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        //default
        // $products = Product::get();

        //descending order
        // $products = Product::orderBy('id', 'DESC')->get();

        //random order
        $products = Product::inRandomOrder()->where('status', 1)->get();
        // dd($products);

        //-----------------------------------
        //category_menu with dirty html echo

        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        // dd($categories);
        return view('index')->with(compact('products',  'categories'));
    }
}
