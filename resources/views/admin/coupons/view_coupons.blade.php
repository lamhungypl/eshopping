@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Coupons</a>
            <a href="#" class="current">View Coupons</a>
        </div>
        <h1>Coupons</h1>
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
                        <h5>View Coupons</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Coupon ID</th>
                                    <th>Coupon Code</th>
                                    <th>Amount</th>
                                    <th>Amount Type</th>
                                    <th>Created Date</th>
                                    <th>Expired Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                <tr class="gradeX">
                                    <td>{{$coupon->id}}</td>

                                    <td>{{$coupon->coupon_code}}</td>
                                    <td>
                                        {{$coupon->amount}}
                                        @if ($coupon->amount_type =='percentage') % @else USD @endif
                                    </td>
                                    <td>{{$coupon->amount_type}}</td>
                                    <td>{{$coupon->created_at}}</td>
                                    <td>{{$coupon->expired_date}}</td>
                                    <td>
                                        
                                        @if ($coupon->status =='1') Active @else Inactive @endif
                                    
                                    </td>

                                    <td class="center">
                                        <a
                                            href="{{url('/admin/edit-coupon/'.$coupon->id )}}"
                                            class="btn btn-primary btn-mini"
                                        >
                                            Edit
                                        </a>
                                         

                                        <a
                                            {{--
                                            id="btn_delete_prod"
                                            --}}
                                            rel="{{$coupon->id}}"
                                            rel1="delete-coupon"
                                            href="javascript:"
                                            {{--
                                            href="{{url('/admin/delete-coupon/'.$coupon->id )}}"
                                            --}}
                                            class="btn btn-danger btn-mini btn_delete_prod"
                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <div id="myModal{{$coupon->id}}" class="modal hide">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">
                                            ×
                                        </button>
                                        <h3>{{$coupon->coupon_code}}</h3>
                                    </div>
                                    <div class="modal-body">
                                        <img
                                            src="{{asset('/images/backend_images/coupons/medium/'.$coupon->image)}}"
                                            width="100px"
                                        />
                                        <p>Coupon ID: {{$coupon->id}}</p>
                                        <p>Category ID: {{$coupon->category_id}}</p>
                                        <p>Coupon Code: {{$coupon->product_code}}</p>
                                        <p>Coupon Color: {{$coupon->product_color}}</p>
                                        <p>Price: {{$coupon->price}}</p>
                                        <p>Description: {{$coupon->description}}</p>
                                        <p>Material & Care: {{$coupon->care}}</p>
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
