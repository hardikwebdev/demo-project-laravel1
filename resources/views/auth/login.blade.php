@extends('layouts.guest')
@section('title', __('custom.sign_in'))

@section('content')
<div class="row w-100 mx-0">
  <div class="col-12 col-lg-6 mx-auto">
    <form method="POST" action="{{ route('login') }}">
        <div class="row align-items-center justify-content-center login-gradient rounded p-3 p-md-5">
          <div class="col-12 text-center">
            <img src="{{ asset('assets/images/assets/Register_Account/Group83.png') }}" class="img-fluid" alt="logo">
        </div>
        <div class="col-12 text-center mt-5">
            <h2 class="font-weight-bold text-white">{{__('custom.welcome_text_desc')}}</h2>
        </div>
        @csrf
        <div class="col-12 mt-5">
            <input id="username" type="username" class="form-control grey-ph h-auto py-4 rounded-0 @error('username') is-invalid @enderror" placeholder="{{__('custom.username')}}" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12 mt-3">
            <input id="password" type="password" class="form-control grey-ph h-auto py-4 rounded-0 @error('password') is-invalid @enderror" placeholder="{{__('custom.password')}}" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn bg-warning text-white py-4 font-weight-bold rounded-0 w-100 text-uppercase" >{{__('custom.sign_in')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png')}}" class="img-fluid ml-3 align-middle" alt=""></button>
        </div>
        <div class="col-12 col-md-6 mt-3 text-white">
            <label class="cus-checkbox d-flex">
              <input class="d-none" type="checkbox">
              <span></span>
              <h4 class="ml-3 text-light-pink">{{__('custom.remember_me')}}</h4> 
          </label>
      </div>
      <div class="col-12 col-md-6 mt-3 text-md-right">
        @if (Route::has('password.request'))
        <h4><a class="text-white" href="{{ route('password.request') }}">{{__('custom.forgot_your_password')}}</a></h4>
        @endif
    </div>
    <div class="col-12">
        <hr class="w-100 border border-white my-3"/>
    </div>
    <div class="col-12 text-center mt-4">
        <h4 class="text-light-pink">{{__('custom.not_amember')}}<a href="{{ route('register') }}" class="text-white ml-2">{{__('custom.sign_up')}}</a></h4>
    </div>
</div>
</form>
</div>
</div>

@endsection
