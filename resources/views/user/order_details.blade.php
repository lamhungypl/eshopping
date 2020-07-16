@extends('layouts.frontLayout.front_design') @section('customStyle')
<style>
    .container-fluid {
        margin-top: 200px;
    }

    p {
        font-size: 14px;
        margin-bottom: 7px;
    }

    .small {
        letter-spacing: 0.5px !important;
    }

    .card-1 {
        box-shadow: 2px 2px 10px 0px rgb(190, 108, 170);
    }

    hr {
        background-color: rgba(248, 248, 248, 0.667);
    }

    .bold {
        font-weight: 500;
    }

    .change-color {
        color: #ab47bc !important;
    }

    .card-2 {
        box-shadow: 1px 1px 3px 0px rgb(112, 115, 139);
    }

    .fa-circle.active {
        font-size: 8px;
        color: #ab47bc;
    }

    .fa-circle {
        font-size: 8px;
        color: #aaa;
    }

    .rounded {
        border-radius: 2.25rem !important;
    }

    .progress-bar {
        background-color: #ab47bc !important;
    }

    .progress {
        height: 5px !important;
        margin-bottom: 0;
    }

    .invoice {
        position: relative;
        top: -70px;
    }

    .Glasses {
        position: relative;
        top: -12px !important;
    }

    .card-footer {
        background-color: #ab47bc;
        color: #fff;
    }

    h2 {
        color: rgb(78, 0, 92);
        letter-spacing: 2px !important;
    }

    .display-3 {
        font-weight: 500 !important;
    }

    @media (max-width: 479px) {
        .invoice {
            position: relative;
            top: 7px;
        }

        .border-line {
            border-right: 0px solid rgb(226, 206, 226) !important;
        }
    }

    @media (max-width: 700px) {
        h2 {
            color: rgb(78, 0, 92);
            font-size: 17px;
        }

        .display-3 {
            font-size: 28px;
            font-weight: 500 !important;
        }
    }

    .card-footer small {
        letter-spacing: 7px !important;
        font-size: 12px;
    }

    .border-line {
        border-right: 1px solid rgb(226, 206, 226);
    }
</style>
@endsection @section('content')
<section>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="container">
            <div class="row">
                <br />
                <div class="col-md-12">
                    <div class="col-md-4 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                        <!--REVIEW ORDER-->
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <h4>Order Items</h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <strong>Subtotal </strong>
                                    <div class="pull-right"><span>$</span><span>{{$orderDetails->subtotal}}</span></div>
                                </div>
                                <div class="col-md-12">
                                    <strong>discount</strong>
                                    <div class="pull-right"><span>$</span><span>{{$orderDetails->coupon_amount}}</span></div>
                                </div>
                                <div class="col-md-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>-</span></div>
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>$</span><span>{{$orderDetails->total}}</span></div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <!--REVIEW ORDER END-->
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                        <!--SHIPPING METHOD-->
                        <div class="panel panel-default">
                            <div class="panel-heading text-center"><h4>Order Item</h4></div>
                            <div class="panel-body">
                                <table class="table borderless">
                                    <thead>
                                        <tr>
                                            <td><strong>Invoice: {{$orderDetails->id}}</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>

                                            <th>Product</th>
                                            <th class="text-center">Size</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Subtotal</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        @foreach ($orderDetails->items as $item)
                                        <tr>
                                            <td class="col-md-3">
                                                <div class="media">
                                                    <a class="thumbnail pull-left" href="#">
                                                        <img
                                                            class="media-object"
                                                            src="{{url('/images/backend_images/products/small/'.$item->image)}}"
                                                            style="width: 72px; height: 72px;"
                                                        />
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$item->product_name}}</h5>
                                                        <h5 class="media-heading">{{$item->product_code}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <th class="text-center">{{$item->size}}</th>

                                            <td class="text-center">${{$item->price}}</td>
                                            <td class="text-center">{{$item->quantity}}</td>
                                            <td class="text-center ">${{$item->price* $item->quantity}}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--SHIPPING METHOD END-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</section>

@endsection
