@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Products</a>
            <a href="#" class="current">View Products</a>
        </div>
        <h1>Products</h1>
        @if (Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session("flash_message_error") }}</strong>
        </div>
        @endif @if (Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session("flash_message_success") }}</strong>
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <hr />
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Product Color</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="gradeX">
                                    <td>{{$product->id}}</td>
                                    <td>
                                        <img
                                            src="{{asset('/images/backend_images/products/small/'.$product->image)}}"
                                            width="70px"
                                        />
                                    </td>
                                    <td>{{$product->category_id}}</td>
                                    <td>{{$product->category_name}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->product_color}}</td>
                                    <td>{{$product->price}}</td>
                                    <td class="center">
                                        <a
                                            href="#myModal{{$product->id}}"
                                            data-toggle="modal"
                                            class="btn btn-success btn-mini"
                                            >View
                                        </a>

                                        <a
                                            href="{{url('/admin/edit-product/'.$product->id )}}"
                                            class="btn btn-primary btn-mini"
                                        >
                                            Edit
                                        </a>
                                        <a
                                            href="{{url('/admin/add-attributes/'.$product->id )}}"
                                            class="btn btn-success btn-mini"
                                            >Add
                                        </a>
                                        <a
                                            href="{{url('/admin/add-images/'.$product->id )}}"
                                            class="btn btn-info btn-mini"
                                            >Add Images
                                        </a>
                                        <a
                                            {{--
                                            id="btn_delete_prod"
                                            --}}
                                            rel="{{$product->id}}"
                                            rel1="delete-product"
                                            href="javascript:"
                                            {{--
                                            href="{{url('/admin/delete-product/'.$product->id )}}"
                                            --}}
                                            class="btn btn-danger btn-mini btn_delete_prod"
                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <div id="myModal{{$product->id}}" class="modal hide">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">
                                            ×
                                        </button>
                                        <h3>{{$product->product_name}}</h3>
                                    </div>
                                    <div class="modal-body">
                                        <img
                                            src="{{asset('/images/backend_images/products/medium/'.$product->image)}}"
                                            width="100px"
                                        />
                                        <p>Product ID: {{$product->id}}</p>
                                        <p>Category ID: {{$product->category_id}}</p>
                                        <p>Product Code: {{$product->product_code}}</p>
                                        <p>Product Color: {{$product->product_color}}</p>
                                        <p>Price: {{$product->price}}</p>
                                        <p>Description: {{$product->description}}</p>
                                        <p>Material & Care: {{$product->care}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
