@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Products</a>
            <a href="#" class="current">Add Products</a>
        </div>
        <h1>Products</h1>
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
                        <div class="widget-content nopadding">
                            <form
                                class="form-horizontal"
                                method="post"
                                action="{{ url('/admin/add-product') }}"
                                name="add_product"
                                id="add_product"
                                novalidate="novalidate"
                                enctype="multipart/form-data"
                            >
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Under Category</label>
                                    <div class="controls">
                                        <select name="category_id" style="width: 220px;">
                                            <?php echo $categories_dropdown;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product name</label>
                                    <div class="controls">
                                        <input type="text" name="product_name" id="product_name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product code</label>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product color</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="product_color"
                                            id="product_color"
                                        />
                                    </div>
                                </div>

                                {{--
                                <div class="control-group">
                                    <label class="control-label">Product levels</label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px;">
                                            <option value="0">Main Product</option>
                                            @foreach ($levels as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                --}}
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Material & Care</label>
                                    <div class="controls">
                                        <textarea name="care" id="care"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Price </label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image </label>
                                    <div class="controls">
                                        <input type="file" name="image" id="image" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1"/>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input
                                        type="submit"
                                        value="Add product "
                                        class="btn btn-success"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
