@extends('layouts.app')

@section('content')
 <div class="content-wrapper">
          <div class="row mt-5 pt-5">
            <div class="col-12">
              <div class="login-gradient rounded text-white py-4 px-5">
                <h2 class="mb-0 font-weight-bold">${{ number_format($userWallet->crypto_wallet, 2)}}</h2>
                <p class="mb-0">{{ trans('custom.balance')}}</p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-5">
            <div class="col-12">
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block fund-usdt-bank active" data-value="usdt" data-toggle="tab" href="#home">{{ trans('custom.usdt')}}</a></li>
                @if(\Auth::user()->country_id == 131)
                <li><a class="text-warning border border-warning py-3 px-5 d-block fund-usdt-bank" data-toggle="tab" data-value="myr-usdt" href="#menu1">{{ trans('custom.malaysia_opg')}}</a></li>
                @endif
              </ul>
            </div>

            <div class="col-12 mt-4">
              @if(Session::has('success'))
              <div class="alert alert-success alert-dismissable">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  {{ Session::get('success') }}
              </div>
              @endif

              @if(Session::has('error'))
              <div class="alert alert-danger alert-dismissable">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  {{ Session::get('error') }}
              </div>
              @endif
              <div class="tab-content border-0">
                <div id="home" class="tab-pane active">
                  <div class="card">
                    <div class="card-body p-md-5">
                      <div class="row">
                        <div class="col-12 pb-3">
                          <h4 class="font-weight-bold">{{ trans('custom.terms_conditions')}}</h4>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>{{ trans('custom.withdrawal_fee_is_usd_10')}}</li>
                            <li>{{ trans('custom.conversion_rate_of_usd_to_usdt_is_0_95')}}</li>
                            <li>{{ trans('custom.members_that_have_funded_in_usdt_previousl')}}</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>{{ trans('custom.withdrawal_fee_is_usd_10')}}</li>
                            <li>{{ trans('custom.conversion_rate_of_usd_to_usdt_is_0_95')}}</li>
                            <li>{{ trans('custom.members_that_have_funded_in_usdt_previousl')}}</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>{{ trans('custom.withdrawal_fee_is_usd_10')}}</li>
                            <li>{{ trans('custom.conversion_rate_of_usd_to_usdt_is_0_95')}}</li>
                            <li>{{ trans('custom.members_that_have_funded_in_usdt_previousl')}}</li>
                          </ul>
                        </div>
                      </div>
                      {{Form::open(['route' => 'cryptoWalletForm','class' => '','id' =>'cryptowalletform','enctype' => 'multipart/form-data'])}}
                      <div class="row mt-4">
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          {{-- <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Amount"> --}}
                          <input type="hidden" name="payment_method" value="usdt">
                          {{Form::text('amount',old('amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow credit_amount usdttt','placeholder' => trans('custom.amount_USD'),'data-usdrate' => @$convertedRateUSDT])}}
                        </div>
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          {{-- <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" id="converted_amount" placeholder="USDT Amount"> --}}
                          {{Form::text('converted_amount',old('converted_amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow usdt-converted_amount','placeholder' => trans('custom.usdt_amount') ,'readonly'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          <input type="password" name="secure_password" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="{{ trans('custom.security_password')}}">
                        </div>
                      </div>
                      <div class="row mt-4">  
                        <div class="col-12 col-md-6 mt-4 mt-md-0">
                          <div class="fallback">
                            <input name="upload_proof" type="file" class="dropify" id="upload_proof"/>
                            <p>USDT Proof png, jpg, jpeg</span>
                            @error('upload_proof')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>  
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white py-4 px-5 rounded-0">{{ trans('custom.topup_fund_submit')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                        </div>
                      </div>
                      {{Form::close()}}
                    </div>
                  </div>
                </div>
                <div id="menu1" class="tab-pane">
                  <div class="card">
                    <div class="card-body p-md-5">
                      <div class="row">
                        <div class="col-12 pb-3">
                          <h4 class="font-weight-bold">{{ trans('custom.terms_conditions')}}</h4>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>{{ trans('custom.withdrawal_fee_is_usd_10')}}</li>
                            <li>{{ trans('custom.conversion_rate_of_usd_to_usdt_is_0_95')}}</li>
                            <li>{{ trans('custom.members_that_have_funded_in_usdt_previousl')}}</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>{{ trans('custom.withdrawal_fee_is_usd_10')}}</li>
                            <li>{{ trans('custom.conversion_rate_of_usd_to_usdt_is_0_95')}}</li>
                            <li>{{ trans('custom.members_that_have_funded_in_usdt_previousl')}}</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>{{ trans('custom.withdrawal_fee_is_usd_10')}}</li>
                            <li>{{ trans('custom.conversion_rate_of_usd_to_usdt_is_0_95')}}</li>
                            <li>{{ trans('custom.members_that_have_funded_in_usdt_previousl')}}</li>
                          </ul>
                        </div>
                      </div>
                      {{Form::open(['route' => 'cryptoWalletForm','class' => '','id' =>'cryptowalletform-myr','enctype' => 'multipart/form-data'])}}
                      <div class="row mt-4">
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          {{-- <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Amount"> --}}
                          <input type="hidden" name="payment_method" value="online">
                          {{Form::text('amount',old('amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow credit_amount_myr usdttt','placeholder' => trans('custom.amount_USD'),'data-usdrate' => @$convertedRateMYR])}}
                        </div>
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          {{-- <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" id="converted_amount" placeholder="USDT Amount"> --}}
                          {{Form::text('converted_amount',old('converted_amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow usdt-myr-converted_amount','placeholder' => trans('custom.usdt_amount') ,'readonly'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          <input type="password" name="secure_password" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="{{ trans('custom.security_password')}}">
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white py-4 px-5 rounded-0">{{ trans('custom.topup_fund_submit')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                        </div>
                      </div>
                      {{Form::close()}}
                    </div>
                  </div>
                </div>
              </div>  
            </div>
          </div>

          <div class="row mt-5">
            <div class="col-12">
              <p class="text-white pb-3">{{ trans('custom.crypto_wallet_history')}}</p>
            </div>
            <div class="col-12">
              @include('crypto_wallet/crypto_walletajax')
            </div>
          </div>
          <div class="row align-items-center mt-5">
            <div class="col-12 text-right">
              <div class="text-secondary">
                @if(isset($cryptowallet)){{$cryptowallet->render('vendor.default_paginate') }}@endif
              </div>
            </div>
          </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $('.credit_amount').on('change', function () {
      var val =  $(this).val();
      var usdRate =  $(this).attr('data-usdrate');
    $('.usdt-converted_amount').val((val * usdRate).toFixed(2));
  });
  $('.credit_amount_myr').on('change', function () {
      var val =  $(this).val();
      var usdRate =  $(this).attr('data-usdrate');
    $('.usdt-myr-converted_amount').val((val * usdRate).toFixed(2));
  });
</script>
@endsection