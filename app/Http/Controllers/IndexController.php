<?php

namespace App\Http\Controllers;

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
        $products = Product::inRandomOrder()->get();
        // dd($products);
        return view('index')->with(compact('products'));
    }
}
