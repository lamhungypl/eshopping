@extends('layouts.frontLayout.front_design') @section('content')
<?php
$couponCode =    isset($_SESSION['CouponCode']) ? $_SESSION['CouponCode']: '';
$couponAmount =    isset($_SESSION['CouponAmount']) ? $_SESSION['CouponAmount']: '';

?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
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
                        <input
                            type="hidden"
                            name="itemId"
                            class="itemId"
                            value="{{$cartItem->id}}"
                        />
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
                                <span class="cart_quantity_up"> + </span>
                                <input
                                    class="cart_quantity_input"
                                    type="text"
                                    name="quantity"
                                    value="{{$cartItem->quantity}}"
                                    autocomplete="off"
                                    size="2"
                                />
                                <span class="cart_quantity_down"> - </span>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{$cartItem->price * $cartItem->quantity}}
                            </p>
                            <span>$</span>
                        </td>
                        <td class="cart_delete">
                            <a
                                class="cart_quantity_delete"
                                href="{{url('/delete-cart-item/'.$cartItem->id)}}"
                                ><i class="fa fa-times"></i
                            ></a>
                        </td>
                    </tr>
                    <?php $initTotalAmount = $initTotalAmount + $cartItem->price *
                    $cartItem->quantity;?> @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>
                Choose if you have a discount code you want to use.
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="{{ url('/cart/apply-coupon') }}" method="post">
                    {{ csrf_field() }}
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code" />
                                <input type="submit" value="Apply" class="btn btn-default" />
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>
                            Total <span id="totalAmount">$<?php echo $initTotalAmount; ?></span>
                        </li>
                        <li style="display: flex; justify-items: space-between;">
                            <span>Coupon :</span>
                            <span id="couponCode" style="flex: 1">
                            @if (!empty(session('couponCode')))
                               {{ session('couponCode')}}
                            @endif    
                            </span>
                            <span id="couponAmount">
                                @if (!empty(session('couponAmount')))
                                {{session('couponAmount')}}
                                @else
                                    0
                                @endif
                            </span>
                        </li>
                        <li>
                            Total
                            <span id="grandTotalAmount">
                                <span>$</span>
                                <?php 
                                    $discount = !empty(session('couponAmount')) ? session('couponAmount') :0;
                                    echo $initTotalAmount - $discount;

                                ?>
                            </span>
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->

@endsection @section('extraJS')
<script src="{{ url('js/app.js') }}"></script>
<script>
    // ahab! something weird!!
    (function () {
        const addButton = document.querySelectorAll(".cart_quantity_up");
        const prices = document.querySelectorAll(".cart_price_value");
        const quantityInput = document.querySelectorAll(".cart_quantity_input");
        const delButton = document.querySelectorAll(".cart_quantity_down");
        const totals = document.querySelectorAll(".cart_total_price");
        const totalAmountNode = document.getElementById("totalAmount");

        const discountNode = document.getElementById("couponAmount");
        const grandTotalAmountNode = document.getElementById("grandTotalAmount");


        const arrayPrice = Array.from(prices);
        const arrayQuantity = Array.from(quantityInput);
        const arrayTotal = Array.from(totals);
        const lineItems = Array.from(document.querySelectorAll(".itemId"));

        const totalAmount = arrTotal => {
            return arrTotal
                .map(node => node.innerHTML)
                .reduce((total, current) => {
                    return total + parseInt(current);
                }, 0);
        };

        Array.from(addButton).forEach((button, index) => {
            button.addEventListener("click", () => {
                // console.log("hi"+arrayQuantity[index].value,lineItems[index].value);
                const currentQuantity = arrayQuantity[index].value;
                const newQuantity = parseInt(currentQuantity) + 1;
                const id = lineItems[index].value;
                axios
                    .post(`/update-cart-item/${id}`, {
                        quantity: newQuantity
                    })
                    .then(function (response) {
                        arrayQuantity[index].value = newQuantity;
                        arrayTotal[index].innerHTML = parseInt(
                            newQuantity * parseInt(arrayPrice[index].innerHTML)
                        );
                        totalAmountNode.innerHTML = "$" + totalAmount(arrayTotal);
                        const discount = parseFloat(discountNode.innerHTML);
                        grandTotalAmountNode.innerHTML = `$ ${totalAmount(arrayTotal) - discount }`;

                    })
                    .catch(function (error) {
                        // console.log(error);
                        alert(error);
                    });
            });
        });
        Array.from(delButton).forEach((button, index) => {
            button.addEventListener("click", () => {
                // console.log("hi"+arrayQuantity[index].value,lineItems[index].value);
                const currentQuantity = arrayQuantity[index].value;
                const newQuantity = parseInt(currentQuantity) - 1;
                if (newQuantity === 0) {
                    return;
                }
                const id = lineItems[index].value;
                axios
                    .post(`/update-cart-item/${id}`, {
                        quantity: newQuantity
                    })
                    .then(function (response) {
                        arrayQuantity[index].value = newQuantity;
                        arrayTotal[index].innerHTML = parseInt(
                            newQuantity * parseInt(arrayPrice[index].innerHTML)
                        );
                        totalAmountNode.innerHTML = "$" + totalAmount(arrayTotal);
                        const discount = parseFloat(discountNode.innerHTML);
                        grandTotalAmountNode.innerHTML = `$ ${totalAmount(arrayTotal) - discount }`;
                    })
                    .catch(function (error) {
                        // console.log(error);
                        alert(error);
                    });
            });
        });
    })();
</script>
@endsection
