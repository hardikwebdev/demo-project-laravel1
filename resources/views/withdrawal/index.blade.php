@extends('layouts.app')
@section('title', __('custom.withdrawals'))
@section('page_title', __('custom.withdrawals'))
@section('content')
<div class="content-wrapper">
<div class="row mt-5 pt-5">
    <div class="col-12">
        <div class="withdrawal-gradient rounded text-white py-4 px-5">
            <h2 class="mb-0 font-weight-bold">${{number_format($userWallet->withdrawal_balance, 2)}}</h2>
            <p class="mb-0">{{ trans('custom.balance')}}</p>
        </div>
    </div>
</div>
<div class="row justify-content-center mt-5">
    <div class="col-12">
        <ul class="nav nav-tabs justify-content-center account-tabs border-0">
            <li><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#home">{{ trans('custom.usdt')}}</a></li>
            <li><a class="text-warning border border-warning py-3 px-5 d-block active" data-toggle="tab" href="#menu1">{{ trans('custom.BANK')}}</a></li>
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
            <div id="home" class="tab-pane">
                <div class="card">
                    <div class="card-body p-md-5">
                        @include('withdrawal.common')
                        {{Form::open(['route' => 'withdrawal-request','class' => '','id' =>'withdrawalform-usdt','enctype' => 'multipart/form-data'])}}
                        <div class="row mt-4">
                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <input type="hidden" name="payment_method" value="usdt">
                                {{Form::number('amount',old('amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow','placeholder' => trans('custom.amount')])}}
                            </div>
                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <input type="password" name="secure_password" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="{{ trans('custom.security_password')}}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-md-6 mt-4 mt-md-0">
                                <div class="fallback">
                                    <input name="upload_proof" type="file" class="dropify" id="upload_proof"/>
                                    <p>USDT Proof png, jpg, jpeg</p>
                                        @error('upload_proof')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <label style="display:none;" id="upload_proof-error" class="error" for="upload_proof"></label>  
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-xl-6 mt-4">
                                <button class="btn bg-warning text-white py-4 px-5 rounded-0">{{ trans('custom.REQUEST_FOR_WITHDRAWAL')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane active">
                <div class="card">
                    <div class="card-body p-md-5">
                        @include('withdrawal.common')
                        {{Form::open(['route' => 'withdrawal-request','class' => '','id' =>'withdrawalform-bank','enctype' => 'multipart/form-data'])}}
                        <div class="row mt-4">
                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <input type="hidden" name="payment_method" value="bank">
                                {{Form::number('amount',old('amount'),['class' => 'form-control grey-ph h-auto py-4 border-0 shadow credit_amount usdttt','placeholder' => trans('custom.amount')])}}
                            </div>
                            <div class="col-12 col-md-4 mt-4 mt-md-0">
                                <input type="password" name="secure_password" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="{{ trans('custom.security_password')}}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-md-6 mt-4 mt-md-0">
                                <div class="fallback">
                                    <input name="upload_proof_bank" type="file" class="dropify" id="upload_proof_bank"/>
                                    <p>Bank Proof png, jpg, jpeg</p>
                                        @error('upload_proof_bank')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <label style="display:none;" id="upload_proof_bank-error" class="error" for="upload_proof_bank"></label>  
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-xl-6 mt-4">
                                <button class="btn bg-warning text-white py-4 px-5 rounded-0">{{ trans('custom.REQUEST_FOR_WITHDRAWAL')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
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
        <p class="text-white pb-3">{{ trans('custom.withdrawal_history')}}</p>
    </div>
    <div class="col-12">
        @include('withdrawal/withdrawlwalletajax')
    </div>
</div>
<div class="row align-items-center mt-5">
    <div class="col-12 text-right">
        <div class="text-secondary">
            @if(isset($withdrawWallet)){{$withdrawWallet->render('vendor.default_paginate') }}@endif
        </div>
    </div>
</div>
@endsection