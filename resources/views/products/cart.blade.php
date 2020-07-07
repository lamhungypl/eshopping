@extends('layouts.frontLayout.front_design') @section('content')

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
                                {{$cartItem->price * $cartItem->quantity}}$
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a
                                class="cart_quantity_delete"
                                href="{{url('/delete-cart-item/'.$cartItem->id)}}"
                                ><i class="fa fa-times"></i
                            ></a>
                        </td>
                    </tr>

                    @endforeach
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
                Choose if you have a discount code or reward points you want to use or would like to
                estimate your delivery cost.
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox" />
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox" />
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox" />
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text" />
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
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

        const arrayPrice = Array.from(prices);
        const arrayQuantity = Array.from(quantityInput);
        const arrayTotal = Array.from(totals);
        const lineItems = Array.from(document.querySelectorAll(".itemId"));
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
                        arrayTotal[index].innerHTML =
                            parseInt(newQuantity * parseInt(arrayPrice[index].innerHTML)) + "$";
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
                        arrayTotal[index].innerHTML =
                            parseInt(newQuantity * parseInt(arrayPrice[index].innerHTML)) + "$";
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
