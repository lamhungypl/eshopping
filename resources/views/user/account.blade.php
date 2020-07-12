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
					<div class="login-form"><!--login form-->
						<h2>Account infomation</h2>
                        <form action="{{url('/login')}}" name="loginForm" id="loginForm" method="POST">
                            {{ csrf_field() }}
							<input name="email" type="text" placeholder="Email" />
							<input name="password" type="text" placeholder="Password" />

						</form>
					</div><!--/login form-->
				</div>

				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Update password</h2>
                        <form action="{{url('/register')}}" method="POST" id="registerForm" name="registerForm" autocomplete="off">
                            {{ csrf_field() }}
							<input name="name" type="text" placeholder="Name" />
							<input name="email" type="email" placeholder="Email Address" autocomplete="off" />
							<input name="password" type="password" placeholder="Password"/>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

</section>
@endsection
