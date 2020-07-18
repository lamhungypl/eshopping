@extends('layouts.adminLayout.admin_design') 
@section('customCSS')
<style>

.purchase
{
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px;
    font-family: Times New Roman;
}
.purchase header
{
    padding: 0px 0px 0px 0px;
    margin-bottom: 0px;
    border-bottom: 1px solid #3989c6;
}
.purchase header img
{
    max-width: 200px;
    margin-top: 0;
    margin-bottom: 0;
}
.purchase .company-details
{
    text-align: right;
    margin-top: 0;
    margin-bottom: 0;
}
.purchase main
{
    padding: 0px 0px;
    margin-bottom: 0px;
}
.purchase .to-details
{
    text-align: left;
}
.purchase .to-name
{
    font-weight: bold;
}
.purchase .to-name .to-address .to-city
{
    margin-top: 0;
    margin-bottom: 0;
}
.purchase .purchase-info
{
    text-align: right;
}
.purchase-info .info-code
{
    font-weight: bold;
}
.purchase-info .info-code .info-date
{
    margin-top: 0;
    margin-bottom: 0;
}
.table thead th
{
    margin: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
.table td
{
    margin: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    border: none;
}
.table .blank-row
{
    height: 25px !important;
    background-color: #FFFFFF;
    border: none;
}
.table tbody
{
    min-height: 760px !important;
}
.layout-content{
    display: flex;

}
.col-left,.col-right{
    flex:1;
    background: #fff;
}
.col-content{
    flex:8;
}
</style>    
@endsection


@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"
                ><i class="icon-home"></i> Admin</a
            >
            <a href="{{ url('/admin/orders') }}">Order</a>
            <a href="#" class="current">View Order Details</a>
        </div>
        <h1>Order Details   </h1>
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
    <div class="layout-content">
        <div class="col-left"></div>
        <div class="col-content">
            <div class="purchase overflow-auto">
                <!--<div style="min-width: 600px">-->
                    <header>
                        <div class="row">
                            <div class="col-sm-3 col-xs-3">
                                <img src="" class="img-responsive" alt="logo">
                            </div>
                            <div class="col-sm-9 col-xs-9 company-details">
                                <div>company address, city, postal</div>
                                <div>company phone +0987654</div>
                                <div>company fax +098765</div>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row">
                            <div class="col-sm-3 col-xs-3 to-details">
                                <div>PURCHASED ORDER FOR :</div>
                                <div class="to-name">
                                    <span>Customer name: </span> 
                                    <span>{{$user->name}}</span>
                                </div>
                                <div class="to-address">
                                    <span>Customer Address: </span> 
                                    <span>{{$user->state}}, </span>
                                    <span>{{$user->city}}, </span>
                                    <span>{{$user->country}}</span>

                                </div>
                                <div class="to-city">
                                    
                                    <span>Postal: </span> 
                                    <span>{{$user->pin_code}}</span>


                                
                                </div>
                            </div>
                            <div class="col-sm-9 col-xs-9 purchase-info">
                                <h4 class="info-code">{{$order->created_at}}</h4>
                            <div class="info-date">Issued : {{$order->updated_at}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-condensed" border="0" cellspacing="0" cellpadding="0" width="80%">
                                <thead>
                                    <tr>
                                        <th class="text-center col-xs-1 col-sm-1">STT</th>
                                        <th class="text-center col-xs-1 col-sm-1">ID</th>
                                        <th class="text-center col-xs-8 col-sm-7">Product name</th>
                                        <th class="text-center col-xs-1 col-sm-1">Qty</th>
                                        <th class="text-center col-xs-1 col-sm-3">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $key=>$item)
                                    <tr>
                                    <td class="col-xs-1 col-sm-1 text-center">{{$key + 1}}</td>
                                        <td class="col-xs-1 col-sm-1 text-center">{{$item->id}}</td>
                                        <td class="col-xs-1 col-sm-8 text-center">
                                            <span>{{$item->product_name}} -- </span>
                                            <span>{{$item->product_code}} -- </span>
                                            <span>{{$item->size}}</span>
                                        </td>
                                        <td class="col-xs-1 col-sm-1 text-center">{{$item->size}}</td>
                                        <td class="col-xs-1 col-sm-1 text-right">{{$item->price* $item->quantity}}</td>
                                    </tr>
                                    @endforeach

                                  
                                   
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-left">
                                            Discount : {{$order->coupon_amount?$order->coupon_amount : 0}}
                                        </th>
                                        <th  class="text-center">Total</th>
                                        <th class="text-right">{{$order->total}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </main>
                <!--</div>-->
            </div>
    
        </div>
        <div class="col-right"></div>  
    </div>
     
</div>


@endsection
