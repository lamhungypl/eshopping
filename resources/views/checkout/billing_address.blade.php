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
                                    <input
                                        type="text"
                                        placeholder="Name"
                                        name="name"
                                        value="{{$userDetails->name}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="Email*"
                                        name="email"
                                        value="{{$userDetails->email}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="City"
                                        name="city"
                                        value="{{$userDetails->city}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="text"
                                        placeholder="State"
                                        name="state"
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
                                        <option 
                                            value="{{$country->country_code}}" 
                                            @if ($country->country_code == $userDetails->country) 
                                            selected = 'selected'
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
                                        value="{{$userDetails->pin_code}}"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                    id="mobile"
                                        type="text"
                                        placeholder="Mobile"
                                        name="mobile"
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
                                <input id="zipcode" type="text" placeholder="Zip / Postal Code *" />
                                <select
                                        id="countrySelectorShipping"
                                        name="country"
                                        style="margin-bottom: 10px;"
                                    >
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                        <option 
                                            value="{{$country->country_code}}" 
                                        >
                                            {{$country->country_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                <input type="text" placeholder="Address" id="addressShipping"/>
                                <input type="text" placeholder="Mobile Phone" id="mobileShipping"/>
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
@section('extraJS')
{{-- <script src="{{ url('js/app.js') }}"></script> --}}
<script>
    // ahab! something weird!!
    $(document).ready(function () {
     $('#copyAddress').click(function () {
         if(this.checked){
            $('#zipcode').val($('#pincode').val());
            $('#zipcode').attr('readonly',true);

            $('#countrySelectorShipping').val($('#countrySelector').val());
            $('#countrySelectorShipping').attr('disabled',true);

            $('#addressShipping').val($('#address').val());
            $('#addressShipping').attr('readonly',true);

            $('#mobileShipping').val($('#mobile').val());
            $('#mobileShipping').attr('readonly',true);
         }else{
            $('#zipcode').attr('readonly',false);
            $('#countrySelectorShipping').attr('disabled',false);
            $('#addressShipping').attr('readonly',false);
            $('#mobileShipping').attr('readonly',false);

         }
    })
    });
</script>
@endsection
