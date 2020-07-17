@extends('layouts.frontLayout.front_design'); 
@section('customStyle')
<style>
body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
}
.tabs {
  /* max-width: 640px; */
  margin: 0 auto;
  padding: 0 20px;
}
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  width: 20%;
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eee;
  border: 1px solid #ddd;
  text-align: center;
  color: #000;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #fff;
}
.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
}



.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}
</style>
@endsection
@section('content');

<section>
    <section id="form"><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Account</li>
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

			<div class="col-md-12">
				<div class="tabs">
					<div class="tab-button-outer">
					  <ul id="tab-button">
						<li><a href="#tab01">Account Infomation</a></li>
					  <li><a href="{{url('/account/order-history')}}">Order History</a></li>
						 
					  </ul>
					</div>
					<div class="tab-select-outer">
					  <select id="tab-select">
						<option value="#tab01">Tab 1</option>
						<option value="#tab02">Tab 2</option>
						 
					  </select>
					</div>
				  
					<div id="tab01" class="tab-contents">
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
						</div>	</div>
					<div id="tab02" class="tab-contents">
					  <h2>Tab 2</h2>
					  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
					</div>
					 
				  </div>
				
	
	
			
			</div>



			</div>
	</section><!--/form-->

</section>
@endsection

@section('extraJS')
<script>
$(function() {
	var $tabButtonItem = $('#tab-button li'),
		$tabSelect = $('#tab-select'),
		$tabContents = $('.tab-contents'),
		activeClass = 'is-active';
  
	$tabButtonItem.first().addClass(activeClass);
	$tabContents.not(':first').hide();
  
	$tabButtonItem.find('a').on('click', function(e) {
	  var target = $(this).attr('href');
  
	  $tabButtonItem.removeClass(activeClass);
	  $(this).parent().addClass(activeClass);
	  $tabSelect.val(target);
	  $tabContents.hide();
	  $(target).show();
	  e.preventDefault();
	});
  
	$tabSelect.on('change', function() {
	  var target = $(this).val(),
		  targetSelectNum = $(this).prop('selectedIndex');
  
	  $tabButtonItem.removeClass(activeClass);
	  $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
	  $tabContents.hide();
	  $(target).show();
	});
  });	

</script>
@endsection
