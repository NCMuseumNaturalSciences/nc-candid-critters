@extends('layouts.frontend.master', ['bodyid' => 'auth'])

@section('content')
<div class="row">
	<div class="col">
		<form class="form justify-content-center horizontal-form" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			<legend>Login</legend>
			<div class="row">
				<div class="col">
					<label for="email">Email</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><ion-icon name="mail"></ion-icon></span>
						</div>
						<input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label for="email">Password</label>
					<div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
						<div class="input-group-prepend">
							<span class="input-group-text"><ion-icon name="lock"></ion-icon></span>
						</div>
						<input id="password" type="password" class="form-control" name="password" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<button type="submit" class="btn btn-primary px-4">Login</button>
				</div>
				<div class="col-6 text-right">
					<a class="btn btn-link px-0" href="{{ route('password.request') }}">
						Forgot Your Password?
					</a>
				</div>
			</div>
		</form>
    </div>
</div>
@endsection
