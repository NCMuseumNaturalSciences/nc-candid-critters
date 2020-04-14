@extends('layouts.frontend.master',  ['bodyid' => 'auth'])

@section('content')
    <div class="row">
        <div class="col">
            <form class="form justify-content-center" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <legend>New User</legend>
                <div class="row">
                    <div class="col">
                        <label for="fname">First Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" placeholder="First Name" required autofocus>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="lname">Last Name</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" placeholder="Last Name" required autofocus>
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="mail"></ion-icon></span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            <div class="invalid-feedback">
                                Please choose an email.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="password">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="lock"></ion-icon></span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <div class="invalid-feedback">
                                Please choose another password.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="confirm-password">Confirm Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="lock"></ion-icon></span>
                            </div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <div class="invalid-feedback">
                                Please enter the same password.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Register</button>
                    </div>
                </div>
        </form>
        </div>
    </div>
@endsection
