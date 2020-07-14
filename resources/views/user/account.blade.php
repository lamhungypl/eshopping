@extends('layouts.frontLayout.front_design'); 
@section('content');

<section>
    <section id="form"><!--form-->
		<div class="container">
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
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form account-form"><!--account form-->
						<h2>Account infomation</h2>
                        <form action="{{url('/account')}}" name="userInfomationForm" id="userInfomationForm" method="POST">
                            {{ csrf_field() }}
							<input name="name" type="text" placeholder="Name..." value="{{$userDetails->name}}"/>	
							<input name="email" type="text" placeholder="Email..." value="{{$userDetails->email}}"/>
							<input name="address" type="text" placeholder="Address..." value="{{$userDetails->address}}"/>
							<input name="city" type="text" placeholder="city..." value="{{$userDetails->city}}">
							<input name="state" type="text" placeholder="state..." value="{{$userDetails->state}}"/>
							<select id="countrySelector" name="country" style="margin-bottom: 10px;">
								<option value="">Select country</option>
								@foreach ($countries as $country)
								<option 
								value="{{$country->country_code}}"
								@if ($country->country_name == $userDetails->country)
									selected
								@endif
								>
									{{$country->country_name}}
								</option>
								@endforeach
							</select>
							<input name="pincode" type="text" placeholder="pincode..." value="{{$userDetails->pin_code}}"/>
							<input name="mobile" type="text" placeholder="mobile..." value="{{$userDetails->mobile}}"/>
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div><!--/account form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Update password</h2>
                        <form action="{{url('/account')}}" method="POST" id="updatePassword" name="updatePassword" autocomplete="off">
                            {{ csrf_field() }}
							<input name="password" type="text" placeholder="Current password" />
							<input name="new-password" type="text" placeholder="New password" autocomplete="off" />
							<input name="confirm-password" type="text" placeholder="Confirm password"/>
							<button type="submit" class="btn btn-default">Update</button>
							
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

</section>
@endsection
