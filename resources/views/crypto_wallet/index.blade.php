@extends('layouts.app')

@section('content')
 <div class="content-wrapper">
          <div class="row mt-5 pt-5">
            <div class="col-12">
              <div class="login-gradient rounded text-white py-4 px-5">
                <h2 class="mb-0 font-weight-bold">${{ number_format($userWallet->crypto_wallet, 2)}}</h2>
                <p class="mb-0">Balance</p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-5">
            <div class="col-12">
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block fund-usdt-bank active" data-value="usdt" data-toggle="tab" href="#home">USDT</a></li>
                @if(\Auth::user()->country_id == 131)
                <li><a class="text-warning border border-warning py-3 px-5 d-block fund-usdt-bank" data-toggle="tab" data-value="myr-usdt" href="#menu1">MALAYSIA OPG</a></li>
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
                          <h4 class="font-weight-bold">Terms & Conditions</h4>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                      </div>
                      {{Form::open(['route' => 'cryptoWalletForm','class' => '','id' =>'cryptowalletform','enctype' => 'multipart/form-data'])}}
                      <div class="row mt-4">
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          {{-- <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Amount"> --}}
                          <input type="hidden" name="payment_method" value="usdt">
                          {{Form::text('amount',old('amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow credit_amount usdttt','placeholder' => trans('custom.amount_USD'),'data-usdrate' => @$convertedRateUSDT])}}
                        </div>
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          {{-- <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" id="converted_amount" placeholder="USDT Amount"> --}}
                          {{Form::text('converted_amount',old('converted_amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow usdt-converted_amount','placeholder' => 'USDT Amount' ,'readonly'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          <input type="password" name="secure_password" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Security Password">
                        </div>
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          <input name="upload_proof" type="file" class="dropify" id="upload_proof"/>
                          <p>USDT Proof png, jpg, jpeg</span>
                          @error('upload_proof')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white py-4 px-5 rounded-0">TOPUP FUND <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
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
                          <h4 class="font-weight-bold">Terms & Conditions</h4>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
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
                          {{Form::text('converted_amount',old('converted_amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow usdt-myr-converted_amount','placeholder' => 'USDT Amount' ,'readonly'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3 mt-4 mt-md-0">
                          <input type="password" name="secure_password" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Security Password">
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white py-4 px-5 rounded-0">TOPUP FUND <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
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
              <p class="text-white pb-3">Crypto Wallet History</p>
            </div>
            <div class="col-12">
              @include('crypto_wallet/crypto_walletajax')
              {{-- <table class="table table-dark trading-table text-center table-responsive-sm">
                <thead class="table-gradient">
                  <tr>
                    <th>DATE</th>
                    <th>AMOUNT</th>
                    <th>DESCRIPTION</th>
                    <th>STATUS</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-success">Approved</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-warning">Pending</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-success">Approved</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-success">Approved</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-danger">Reject</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-danger">Reject</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-danger">Reject</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-warning">Pending</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-warning">Pending</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-success">Approved</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                  <tr>
                    <td>12/09/2021</td>
                    <td>$1,000</td>
                    <td>Transfer To Withdrawal Wallet</td>
                    <td class="text-success">Approved</td>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                    </td>
                  </tr>
                </tbody>
              </table> --}}
            </div>
          </div>
          <div class="row align-items-center mt-5">
            <div class="col-12 text-right">
              <div class="text-secondary">
                @if(isset($cryptowallet)){{$cryptowallet->render() }}@endif
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