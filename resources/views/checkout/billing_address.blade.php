@extends('layouts.frontLayout.front_design') @section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
                <li class="active">Shipping address</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <div class="shopper-informations">
            <form class="baseForm" action="/checkout/order-review" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-8 clearfix">
                        <div class="bill-to">
                            <div class="form-one">
                                <p>Billing address</p>
                                <div class="form-group">
                                    <input type="text" placeholder="Company Name" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Email*" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Title" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="First Name *" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Middle Name" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Last Name *" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Address 1 *" />
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Address 2" />
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
                                <input type="text" placeholder="Zip / Postal Code *" />
                                <select>
                                    <option>-- Country --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <select>
                                    <option>-- State / Province / Region --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <input type="password" placeholder="Confirm password" />
                                <input type="text" placeholder="Phone *" />
                                <input type="text" placeholder="Mobile Phone" />
                                <input type="text" placeholder="Fax" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea
                                name="message"
                                placeholder="Notes about your order, Special Notes for Delivery"
                                rows="16"
                            ></textarea>
                            <label><input type="checkbox" /> Shipping to bill address</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <div class="col-12">
                        <button type="submit" class="btn btn-default">Next step</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--/#cart_items-->

@endsection
