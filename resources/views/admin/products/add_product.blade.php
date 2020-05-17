@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Products</a>
            <a href="#" class="current">Add Products</a>
        </div>
        <h1>Products</h1>
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
                            >
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Select</label>
                                    <div class="controls">
                                        <select style="width: 220px">
                                           <?php echo $categories_dropdown;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product name</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="product_name"
                                            id="product_name"
                                        />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product code</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="product_code"
                                            id="product_code"
                                        />
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

                                {{-- <div class="control-group">
                                    <label class="control-label">Product levels</label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px">
                                            <option value="0">Main Product</option>
                                            @foreach ($levels as $val)
                                            <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description"></textarea>
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
 