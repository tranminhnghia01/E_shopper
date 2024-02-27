@extends('frontend.layouts.app')
@section('container')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				@if (session('msg'))
					<div class="alert alert-{{session('style')}}">
						{{ session('msg') }}
					</div>
				@endif
				<div class="col-sm-4">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#" method="POST">
							@csrf
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				@include('frontend.user.register')
			</div>
		</div>
	</section><!--/form-->
	
@endsection