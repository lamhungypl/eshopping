@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Products</a>
            <a href="#" class="current">View Orders</a>
        </div>
        <h1>Orders</h1>
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
                        <h5>View Orders</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table
                            id="example"
                            class="table table-striped table-bordered"
                            style="width: 100%;"
                        >
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Payment Method</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key=>$item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$users[$key]->name}}</td>
                                    <td>{{$item->payment}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->order_status}}</td>
                                    <th>{{$item->total}}</th>
                                    <td>
                                        <a 
                                        class="btn btn-info btn-mini"
                                        href="{{url('/admin/orders/'.$item->id)}}">
                                            View Details
                                        </a>
                                        <a
                                        href="{{url('/admin/edit-orders/'.$item->id )}}"
                                        class="btn btn-primary btn-mini"
                                    >
                                        Edit
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
