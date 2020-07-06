@extends('layouts.frontLayout.front_design') @section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img
                                id="mainImage"
                                src="{{ asset('/images/backend_images/products/large/'.$productDetails->image) }}"
                                alt=""
                            />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach ($productAltImages as $altImage) {{--
                                    <a href="">
                                        --}}
                                        <img
                                            class="changeImage"
                                            width="60px"
                                            src="{{
                                            asset('/images/backend_images/products/small/'.$altImage->image)
                                        }}"
                                            alt=""
                                            style="cursor: pointer;"
                                        />
                                        {{--
                                    </a>
                                    --}} @endforeach
                                </div>
                            </div>

                            <!-- Controls -->
                            {{--
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                            --}}
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information">
                            <!--/product-information-->
                            <img
                                src="{{ asset('/images/frontend_images/product-details/new.jpg') }}"
                                class="newarrival"
                                alt=""
                            />
                            <h2>{{$productDetails->product_name}}</h2>
                            <p>Code: {{$productDetails->product_code}}</p>
                            <p>
                                <select name="size" id="sizeSelector" style="width: 150px;">
                                    <option value="">Select Size</option>
                                    @foreach ($productDetails->attributes as $att)
                                    <option
                                        value="{{$productDetails->id }}-{{$att->size}}"
                                        >{{$att->size}}</option
                                    >
                                    @endforeach
                                </select>
                            </p>

                            <img
                                src="{{
                                    asset('/images/frontend_images/product-details/rating.png')
                                }}"
                                alt=""
                            />
                            <span>
                                <span>US </span
                                ><span id="optionPrice">${{$productDetails->price}}</span>
                                <label>Quantity:</label>
                                <input type="text" value="1" />
                                @if ($total_stock > 0)
                                <button type="button" class="btn btn-fefault cart" id="cartButton">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                                @endif
                            </span>
                            <p>
                                <b>Availability:</b>
                                @if ($total_stock > 0) In Stock @else Out of stock @endif
                            </p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> E-SHOPPER</p>
                            <a href=""
                                ><img
                                    src="{{
                                        asset('/images/frontend_images/product-details/share.png')
                                    }}"
                                    class="share img-responsive"
                                    alt=""
                            /></a>
                        </div>
                        <!--/product-information-->
                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#description" data-toggle="tab">Description</a>
                            </li>
                            <li><a href="#care" data-toggle="tab">Material & care</a></li>
                            <li><a href="#delivery" data-toggle="tab">Delivery Option</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="description">
                            <div class="col-sm-12">
                                <div class="tab-content-wrapper">
                                    <p>
                                        {{$productDetails->description}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="care">
                            <div class="col-sm-12">
                                <div class="tab-content-wrapper">
                                    <p>
                                        {{$productDetails->care}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="delivery">
                            <div class="col-sm-12">
                                <div class="tab-content-wrapper">
                                    <p class="">100% Original Products</p>
                                    <p class="">Free Delivery on order above Rs. 799</p>
                                    <p class="">Pay on delivery might be available</p>
                                    <p class="">Easy 30 days returns and exchanges</p>
                                    <p class="">Try & Buy might be available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($relatedProductsChunks3 as $chunks3) 
                            @if ($loop->first)
                                <div class="item active">
                            @else
                                <div class="item">
                            @endif 
                            @foreach ($chunks3 as $item)
                                <div class="col-sm-4">
                                <a href="{{url('/products/'.$item['id'])}}">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img
                                                    src="{{
                                                        asset(
                                                            '/images/backend_images/products/small/'.$item['image']
                                                        )
                                                    }}"
                                                    alt=""
                                                />
                                                <h2>${{$item['price']}}</h2>
                                                <p>{{$item['product_name']}}</p>
                                                <button
                                                    type="button"
                                                    class="btn btn-default add-to-cart"
                                                >
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                    
                                </div>
                            @endforeach
                                </div>
                            @endforeach
                            </div>
                            <a
                                class="left recommended-item-control"
                                href="#recommended-item-carousel"
                                data-slide="prev"
                            >
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a
                                class="right recommended-item-control"
                                href="#recommended-item-carousel"
                                data-slide="next"
                            >
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!--/recommended_items-->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
