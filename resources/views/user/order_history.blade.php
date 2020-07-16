@extends('layouts.frontLayout.front_design') @section('content');

<section>
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Account</a></li>
                <li class="active">Order History</li>
            </ol>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table id="example" class="table table-striped table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->payment}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->order_status}}</td>
                        <td>
                            <a href="{{url('/account/orders/'.$item->id)}}">
                                View Details
                            </a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</section>
@endsection
