@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Categories</a>
            <a href="#" class="current">Edit Categories</a>
        </div>
        <h1>Categories</h1>
    </div>
    <div class="container-fluid">
        <hr />

        <div class="row-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
                            <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Category</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form
                                class="form-horizontal"
                                method="post"
                                action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}"
                                name="edit_category"
                                id="edit_category"
                                novalidate="novalidate"
                            >
                                {{ csrf_field() }}
                                <div class="control-group">
                                    <label class="control-label">Category name</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="category_name"
                                            id="category_name"
                                            value="{{$categoryDetails->name}} "
                                        />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Category levels</label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px;">
                                            <option value="0">Main Category</option>
                                            @foreach ($levels as $val)
                                            {{-- {{dd($val)}} --}}
                                            <option
                                                value="{{$val->id}}"
                                                {{ ($val->id == $categoryDetails->parent_id)?'selected':'' }}
                                            >
                                                {{$val->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description">
                                            {{$categoryDetails->description}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Url</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="url"
                                            id="url"
                                            value="{{$categoryDetails->url}} "
                                        />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input
                                            type="checkbox"
                                            name="status"
                                            id="status"
                                            {{$categoryDetails->status ? "checked" : "" }}
                                        />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input
                                        type="submit"
                                        value="Update category "
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
