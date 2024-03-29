@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Products</a>
            <a href="#" class="current">Add Products Images</a>
        </div>
        <h1>Products Attributes</h1>
        <div class="message">
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
    </div>
    <div class="container-fluid">
        <hr />

        <div class="row-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"><i class="icon-info-sign"></i></span>
                            <h5>Add Product Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form
                                class="form-horizontal"
                                method="post"
                                action="{{ url('/admin/add-images/'.$productDetails->id) }}"
                                name="add_images"
                                id="add_images"
                                {{--
                                novalidate="novalidate"
                                --}}
                                enctype="multipart/form-data"
                            >
                                {{ csrf_field() }}
                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="{{$productDetails->id}}"
                                />
                                <div class="control-group">
                                    <label class="control-label">Product name</label>
                                    <label
                                        class="control-label"
                                        >{{$productDetails->product_name}}</label
                                    >
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product code</label>
                                    <label
                                        class="control-label"
                                        >{{$productDetails->product_code  }}</label
                                    >
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image </label>
                                    <div class="controls">
                                        <input
                                            type="file"
                                            name="image[]"
                                            id="image"
                                            multiple="multiple"
                                        />
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input
                                        type="submit"
                                        value="Add Images"
                                        class="btn btn-success"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Image ID</th>
                                    <th>Product Image</th>
                                    <th>Image</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productsImages as $image)
                                <tr>
                                    <td>{{$image->id}}</td>
                                    <td>{{$image->product_id}}</td>
                                    <td>
                                        <img
                                            width="100px"
                                            src=" {{asset('images/backend_images/products/small/'.$image->image) }}"
                                        />
                                    </td>
                                    <td>
                                        <a
                                            {{--
                                            id="btn_delete_prod"
                                            --}}
                                            rel="{{$image->id}}"
                                            rel1="delete-product-alt-image"
                                            href="javascript:"
                                            {{--
                                            href="{{url('/admin/delete-product/'.$product->id )}}"
                                            --}}
                                            title="delete product image"
                                            class="btn btn-danger btn-mini btn_delete_prod"
                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
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
