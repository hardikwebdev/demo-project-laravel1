@extends('layouts.app')
@section('title', __('custom.nft_wallet'))
@section('page_title', __('custom.nft_wallet'))
@section('content')
 <div class="content-wrapper">
          <div class="row mt-5 pt-5">
            <div class="col-12">
              <div class="login-gradient rounded text-white py-4 px-5">
                <h2 class="mb-0 font-weight-bold">${{ number_format($wallet->nft_wallet, 2)}}</h2>
                <p class="mb-0">Balance</p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-5">
            <div class="col-12">
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block active" data-toggle="tab" href="#home">USDT</a></li>
                <li><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu1">MALAYSIA OPG</a></li>
              </ul>
            </div>

            <div class="col-12 mt-4">
              <div class="tab-content border-0">
                <div id="home" class="tab-pane active">
                  <div class="card">
                    <div class="card-body p-md-5">
                      <div class="row">
                        <div class="col-12 pb-3">
                          <h4 class="font-weight-bold">Terms & Conditions</h4>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                         
                            {!! trans('custom.nft_wallet_terms_and_conditions1') !!}
                          
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                         
                            {!! trans('custom.nft_wallet_terms_and_conditions2') !!}
                          
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          
                            {!! trans('custom.nft_wallet_terms_and_conditions3') !!}

                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-12 col-md-4">
                          <select class="form-control text-grey font-weight-bold h-auto py-4 border-0 outline-0 shadow">
                            <option value="">Select Fund Type</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Amount">
                        </div>
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Security Password">
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white py-4 px-5 rounded-0">TOPUP FUND <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="menu1" class="tab-pane">
                </div>
              </div>  
            </div>
          </div>
          <div class="table-responsive table-history">
            @include('nft_wallet.history')
          </div>
          <!-- content-wrapper ends -->
@endsection