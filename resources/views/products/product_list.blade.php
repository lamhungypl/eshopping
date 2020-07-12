@extends('layouts.frontLayout.front_design'); @section('content');

<section id="advertisement">
    <div class="container">
        <img src="{{ asset('images/frontend_images/shop/advertisement.jpg') }}" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">{{$category->name}}</h2>
                    @foreach ($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img
                                        src="{{
                                            asset('images/backend_images/products/medium/'.$product->image)
                                        }}"
                                        alt=""
                                    />
                                    <h2>${{$product->price}}</h2>
                                    <p>{{$product->name}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"
                                        ><i class="fa fa-shopping-cart"></i>Add to cart</a
                                    >
                                </div>
                                <div
                                    class="product-overlay"
                                    style="background: rgba(0, 0, 0, 0.3);"
                                >
                                    <div class="overlay-content">
                                        <h2>${{$product->price}}</h2>
                                        <p>{{$product->name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"
                                            ><i class="fa fa-shopping-cart"></i>Add to cart</a
                                        >
                                        <a href="{{url('/products/'.$product->id)}}" class="btn btn-default add-to-cart"
                                        ><i class="fa fa-shopping-cart"></i>Go to detail</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href=""
                                            ><i class="fa fa-plus-square"></i>Add to wishlist</a
                                        >
                                    </li>
                                    <li>
                                        <a href=""
                                            ><i class="fa fa-plus-square"></i>Add to compare</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-sm-9">
                        <div class="row">
                            <ul class="pagination">
                                <li class="active"><a href="">1</a></li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                                <li><a href="">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection
