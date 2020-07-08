@extends('layouts.adminLayout.admin_design') @section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Home</a
            >
            <a href="#">Coupons</a>
            <a href="#" class="current">Add Coupons</a>
        </div>
        <h1>Coupons</h1>
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
                                action="{{ url('/admin/add-coupon') }}"
                                name="add_coupon"
                                id="add_coupon"
                                novalidate="novalidate"
                                enctype="multipart/form-data"
                            >
                                {{ csrf_field() }}
                               
                                <div class="control-group">
                                    <label class="control-label">Coupon code</label>
                                    <div class="controls">
                                        <input type="text" name="coupon_code" id="coupon_code" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Amount</label>
                                    <div class="controls">
                                        <input type="text" name="amount" id="amount" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Amount type</label>
                                    <div class="controls">
                                        <select name="amount_type" style="width: 220px;">
                                            <option value="percentage">percentage</option>
                                            <option value="fixed">fixed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Expired date</label>
                                    <div class="controls">
                                        <input
                                            type="text"
                                            name="expired_date"
                                            id="expired_date"
                                        />
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
