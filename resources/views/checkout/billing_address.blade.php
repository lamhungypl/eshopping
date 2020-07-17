@extends('layouts.frontLayout.front_design') @section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
                <li class="active">Shipping address</li>
                <li class="active">Order review</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <form class="baseForm" action="/checkout/place-order" method="post">
            {{ csrf_field() }}
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8 clearfix">
                        <div class="bill-to">
                            <div class="form-one">
                                <p>Billing address</p>
                                <div class="form-group">
                                <input type="hidden" name="user_id" value="{{$userDetails->id}}">
                                    <input
                                        id="name"
                                        type="text"
                                        placeholder="Name"
                                        name="name"
                                        readonly
                                        value="{{$userDetails->name}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="Email*"
                                        name="email"
                                        readonly

                                        value="{{$userDetails->email}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="City"
                                        name="city"
                                        readonly

                                        value="{{$userDetails->city}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="State"
                                        name="state"
                                        readonly

                                        value="{{$userDetails->state}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <select
                                        id="countrySelector"
                                        name="country"
                                        style="margin-bottom: 10px;"
                                    >
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->country_code}}" 
                                            @if ($country->country_code == $userDetails->country) 
                                            selected ='selected' 
                                            @endif 
                                        >
                                            {{$country->country_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input
                                        id="pincode"
                                        type="text"
                                        placeholder="Pincode"
                                        name="pincode"
                                        readonly

                                        value="{{$userDetails->pin_code}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        id="mobile"
                                        type="text"
                                        placeholder="Mobile"
                                        name="mobile"
                                        readonly

                                        value="{{$userDetails->mobile}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input id="address" type="text" placeholder="Address 2" />
                                </div>

                                <div
                                    class="form-check"
                                    style="display: flex; justify-content: flex-start;"
                                >
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="copyAddress"
                                        style="width: auto; margin-right: 16px;"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="copyAddress"
                                        style="flex: 1;"
                                    >
                                        Shipping Address same as Billing Address
                                    </label>
                                </div>
                            </div>
                            <div class="form-two">
                                <p>Shipping address</p>
                                <input
                                    id="nameShipping"
                                    type="text"
                                    placeholder="Name"
                                    name="nameShipping"
                                />
                                <select
                                    id="countrySelectorShipping"
                                    name="countrySelectorShipping"
                                    style="margin-bottom: 10px;"
                                >
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->country_code}}">
                                        {{$country->country_name}}
                                    </option>
                                    @endforeach
                                </select>
                                <input
                                    type="text"
                                    placeholder="Address"
                                    id="addressShipping"
                                    name="addressShipping"
                                />
                                <input
                                    type="text"
                                    placeholder="Mobile Phone"
                                    id="mobileShipping"
                                    name="mobileShipping"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea
                                name="orderNote"
                                placeholder="Notes about your order, Special Notes for Delivery"
                                rows="16"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $initTotalAmount = 0;?>
                        @foreach ($cartList as $cartItem)
                        <tr>
                            <td class="cart_product">
                                <a href="{{url('/products/'.$cartItem->product_id)}}"
                                    ><img
                                        width="100px"
                                        height="100px"
                                        src="{{url('images/backend_images/products/small/'.$cartItem->image)}}"
                                        alt=""
                                /></a>
                            </td>
                            <td class="cart_description">
                                <h4>
                                    <a
                                        href="{{url('/products/'.$cartItem->product_id)}}"
                                        >{{$cartItem->product_name}}</a
                                    >
                                </h4>
                                <p>
                                    <span> {{$cartItem->product_code}} | {{$cartItem->size}} </span>
                                </p>
                            </td>
                            <td class="cart_price">
                                <p class="cart_price_value">{{$cartItem->price}}</p>
                                $
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    {{$cartItem->quantity}}
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{$cartItem->price * $cartItem->quantity}}
                                </p>
                                <span>$</span>
                            </td>
                        </tr>
                        <?php 
                        $initTotalAmount = $initTotalAmount + $cartItem->price * $cartItem->quantity;
                        ?>
                        @endforeach
                        

                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$<?php echo $initTotalAmount; ?>
                                        <input type="hidden" name="subtotal" value="{{$initTotalAmount}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>$
                                            <?php 
                                            $discount = $couponAmount ? $couponAmount : 0;
                                            echo $discount; 
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>${{$initTotalAmount - $discount}}</span>
                                        <input type="hidden" name="total" value="{{$initTotalAmount - $discount}}">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="payment-options">
                <span>
                    <label><input type="radio" name="payment" checked value="Bank"/> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="radio" name="payment" value="COD"/> Cash On Delivery</label>
                </span>
            </div>
            <div class="discount">
            <input type="hidden" name="couponCode" value="{{$couponCode}}">
            <input type="hidden" name="couponAmount" value="{{$couponAmount}}">
            </div>
            <div class="d-flex flex-row-reverse">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Place order</button>
                </div>
            </>
        </form>
        
    </div>
</section>
<!--/#cart_items-->

@endsection @section('extraJS') {{--
<script src="{{ url('js/app.js') }}"></script>
--}}
<script>
    // ahab! something weird!!
    $(document).ready(function () {
        $("#copyAddress").click(function () {
            if (this.checked) {
                $("#nameShipping").val($("#name").val());
                $("#nameShipping").attr("readonly", true);

                $("#countrySelectorShipping").val($("#countrySelector").val());
                $("#countrySelectorShipping").attr("disabled", true);

                $("#addressShipping").val($("#address").val());
                $("#addressShipping").attr("readonly", true);

                $("#mobileShipping").val($("#mobile").val());
                $("#mobileShipping").attr("readonly", true);
            } else {
                $("#nameShipping").attr("readonly", false);
                $("#countrySelectorShipping").attr("disabled", false);
                $("#addressShipping").attr("readonly", false);
                $("#mobileShipping").attr("readonly", false);
            }
        });
    });
</script>
@endsection
