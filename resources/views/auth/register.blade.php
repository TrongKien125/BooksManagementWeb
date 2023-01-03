@extends('frontend.layouts.app')

@section('content')

  <div class="login-area page-area">
    <div class="container">
      <div class="row">
          <div class="col-md-8 border p-4">
            <form method="POST" action="{{ route('register') }}">
            @csrf

              <h3>Create New Account</h3>
              <hr>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="exampleInputEmail1"> Name</label>
                    
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Enter your email address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="********">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
              </div>
              
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
              </div>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Register Now</button>
            </form>
          </div>
          <div class="col-md-4 border p-4">
            <h4>Already have an account  ?</h4>
            <p>
              <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login Now</a>
            </p>
          </div>
      </div>
    </div>
  </div>
@endsection
