@extends('layouts.app')
<style>
.cropit-preview {
    background-color: #f8f8f8;
    background-size: cover;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-top: 7px;
    width: 200px !important;
    height: 200px !important;
}
.cropit-preview-image-container {
    cursor: move;
}
.image-size-label {
    margin-top: 10px;
}
input {
    display: block;
}
button[type="submit"] {
    margin-top: 10px;
}
#result {
    margin-top: 10px;
    width: 900px;
}
#result-data {
    display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    word-wrap: break-word;
}
.image-editor {width: 200px;}
.cus-nav-slick {
    color: #3D4054 !important;
}
.investmentplan-slider{
  display: none;
  visibility: hidden;
}
.investmentplan-slider.slick-initialized{
  display: block;
  visibility: visible;
}

</style>
@section('title', __('custom.profile'))
@section('page_title', __('custom.profile'))
@section('content')
<div class="content-wrapper">
          <div class="row mt-5 pt-5">
            <div class="col-12 col-xl-4 grid-margin stretch-card mb-0">
              <div class="card tale-bg overflow-hidden bg-white pb-3">
                <div class="bg-warning p-4 pb-5">
                  <h4 class="text-white pb-2">My profile</h4>
                </div>
                <div class="px-4 cus-my-profile-img">
                  <img src="{{ asset('assets/images/assets/Dashboard/Group853.png') }}" class="rounded-circle img-fluid" alt="">
                  <a href="#profile-upload" data-toggle="modal" data-target="#profile-upload" class="font-10 d-block"><u>Edit Photo</u></a>
                </div>
                <div class="row px-4 mt-4">
                  <div class="col-md-6">
                      <h4 class="text-dark font-weight-bold mb-0">{{ @$user->name}}</h4>
                      <span class="text-secondary font-12">Full name</span>
                  </div>
                  {{-- <div class="col-md-6">
                    <h4 class="text-dark font-weight-bold mb-0">Gold</h4>
                    <span class="text-secondary font-12" >Rank</span>
                  </div> --}}
                </div>
                <div class="row px-4 mt-4">
                  <div class="col-md-6">
                      <h4 class="text-secondary mb-0">{{ @$user->email}}</h4>
                      <span class="text-secondary font-12">Email</span>
                  </div>
                  <div class="col-md-6">
                    <h4 class="text-secondary mb-0">{{ @$user->phone_number}}</h4>
                    <span class="text-secondary font-12">Phone number</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-8 mt-4 mt-xl-0">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body pb-xl-1 pt-xl-2">
                      <div class="row align-items-center">
                        <div class="col-12 col-xl-4">
                          <div class="row align-iems-center justify-content-between">
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">{{ Helper::defixFinanceID($user->id, date("d-m-Y",strtotime($user->created_at)))}}</h4>
                              <span class="text-secondary font-10">Defix Finance ID</span>
                            </div>
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">******{{ substr($user->phone_number, -4)}}</h4>
                              <span class="text-secondary font-10">Phone number</span>
                            </div>
                          </div>
                          <div class="row align-iems-center justify-content-between mt-4">
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">{{ date("d/m/Y",strtotime($user->created_at)) }}</h4>
                              <span class="text-secondary font-10">Date Joined</span>
                            </div>
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">{{ $staking_pool_count}}</h4>
                              <span class="text-secondary font-10">Total Staking Packag</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-xl-8">
                          <div class="collection-slider">
                            <?php $i = 1; ?>
                            @foreach($staking_pool as $stakingpool)
                            @if($i == 1)
                            <div>
                              <div class="bg-card-{{$i}} text-center p-4 pb-5 rounded mx-2">
                                <img src="{{asset('assets/images/assets/Dashboard/Group929.png')}}" class="img-fluid card-img-top" alt="">
                                <h4 class="text-white">{{$stakingpool->name}}</h4>
                                <p class="text-white font-12">{!! \Illuminate\Support\Str::limit($stakingpool->description,50) !!}</p>
                                <hr/>
                                <p class="text-white font-12">{{__('custom.expected_anual_rate')}}</p>
                                <h3 class="text-white font-weight-bold">{{$stakingpool->stacking_display_start}}% - {{$stakingpool->stacking_display_end}}%</h3>
                                @if($stakingpool->investedAmount > 0)
                                <div class="d-flex justify-content-around mt-2">
                                  <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                  <button class="btn bg-blue text-white rounded-0 px-4">${{number_format($stakingpool->investedAmount,2)}}</button>
                                </div>
                                <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-1-btn position-absolute" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
                                @endif
                              </div>
                            </div>
                            <div>
                              @elseif($i == 2)
                              <div class="bg-card-2 text-center p-4 pb-5 rounded mx-2">
                                <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
                                <h4 class="text-white">{{$stakingpool->name}}</h4>
                                <p class="text-white font-12">{!! \Illuminate\Support\Str::limit($stakingpool->description,50) !!}</p>
                                <hr/>
                                <p class="text-white font-12">{{__('custom.expected_anual_rate')}}</p>
                                <h3 class="text-white font-weight-bold">{{$stakingpool->stacking_display_start}}% - {{$stakingpool->stacking_display_end}}%</h3>
                                @if($stakingpool->investedAmount > 0)
                                <div class="d-flex justify-content-around mt-2">
                                  <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                  <button class="btn bg-blue text-white rounded-0 px-4">${{number_format($stakingpool->investedAmount,2)}}</button>
                                </div>
                                <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-2-btn position-absolute" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
                                @endif
                              </div>
                            </div>
                            <div>
                              @elseif($i == 3)
                              <div class="bg-card-3 text-center p-4 pb-5 rounded mx-2 ">
                                <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
                                <h4 class="text-white">{{$stakingpool->name}}</h4>
                                <p class="font-12 text-white">{!! \Illuminate\Support\Str::limit($stakingpool->description,50) !!}</p>
                                <hr/>
                                <p class="text-white font-12">{{__('custom.expected_anual_rate')}}</p>
                                <h3 class="text-white font-weight-bold">{{$stakingpool->stacking_display_start}}% - {{$stakingpool->stacking_display_end}}%</h3>
                                
                                @if($stakingpool->investedAmount > 0)
                                <div class="d-flex justify-content-around mt-2">
                                  <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                  <button class="btn bg-blue text-white rounded-0 px-4">${{number_format($stakingpool->investedAmount,2)}}</button>
                                </div>
                                <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-3-btn position-absolute" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
                                @endif
                              </div>
                            </div>
                            @elseif($i == 4)
                            <div>
                              <div class="bg-card-4 text-center p-4 pb-5 rounded mx-2 position-relative">
                                <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
                                <h4>{{$stakingpool->name}}</h4>
                                <p class="font-12">{!! \Illuminate\Support\Str::limit($stakingpool->description,50) !!}</p>
                                <hr/>
                                <p class="text-blue font-12">{{__('custom.expected_anual_rate')}}</p>
                                <h3 class="text-blue font-weight-bold">{{$stakingpool->stacking_display_start}}% - {{$stakingpool->stacking_display_end}}%</h3>
                                @if($stakingpool->investedAmount > 0)
                                <div class="d-flex justify-content-around mt-2">
                                  <p class="text-dark font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                  <button class="btn bg-blue text-white rounded-0 px-4">${{number_format($stakingpool->investedAmount,2)}}</button>
                                </div>
                                <a class="btn bg-warning text-white px-3 rounded-0 font-10 mt-2 card-4-btn" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                <a class="btn bg-warning text-white px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool',$stakingpool->id) }}">{{__('custom.stake')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>

                                @endif
                              </div>
                            </div>
                            @endif
                            <?php 
                            $i++; 
                            if($i == 5){
                              $i=1;
                            }
                            ?>

                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mt-5">
            <div class="col-12">
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
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block active" data-toggle="tab" href="#home">PERSONAL DETAILS</a></li>
                {{-- <li class="mt-3 mt-md-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu1">ACCOUNT DETAILS </a></li> --}}
                <li class="mt-3 mt-md-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu1">BANK DETAILS</a></li>
                <li class="mt-3 mt-xl-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu2">CRYPTO WALLETE DETAILS</a></li>
              </ul>
            </div>
            <div class="col-12 mt-4">
              <div class="tab-content border-0">
                <div id="home" class="tab-pane active">
                  {!! Form::open(['route' => 'personal-detail-upadte','enctype' => 'multipart/form-data','id'=>'personal-detail-upadte', 'method'=>'POST'])!!}
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <input name="id" type="hidden" class="form-control blue-ph h-auto py-4" value="{{ $user->id }}">
                      <input name="fullname" type="text" class="form-control blue-ph h-auto py-4" value="{{ $user->name }}"  placeholder="Full Name">
                    </div>
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                      <input name="username" type="text" class="form-control blue-ph h-auto py-4" placeholder="Username" value="{{ $user->username }}" readonly="readonly">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input name="email" type="text" class="form-control blue-ph h-auto py-4" placeholder="Email" value="{{ $user->email }}" readonly="readonly">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input name="phone_number" type="text" class="form-control blue-ph h-auto py-4" value="{{ $user->phone_number}}" placeholder="Phone Number">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input id="address" name="address" type="text" class="form-control blue-ph h-auto py-4"
                      name="address" value="{{ $user->address }}" autocomplete="address" autofocus
                      placeholder="{{trans('custom.address')}}">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" name="state" class="form-control h-auto py-4" value="{{ $user->state }}" placeholder="State">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" name="city" class="form-control h-auto py-4" value="{{ $user->city }}" placeholder="City">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      {!! Form::select('country',$country,old('country_id', $user->country_id),['class'=>'form-control h-auto py-4','placeholder'=>trans('custom.select_country'),'id'=>'country_id']) !!}
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE PROFILE <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
                <div id="menu1" class="tab-pane">
                  {!! Form::open(['route' => 'bank-detail-upadte','enctype' => 'multipart/form-data','id'=>'bank-detail-upadte', 'method'=>'POST'])!!}
                  <div class="row">
                    <input name="id" type="hidden" class="form-control blue-ph h-auto py-4" value="{{ $user->id }}">
                    <div class="col-12 col-md-6">
                      <input id="bank_name" type="text" class="form-control blue-ph h-auto py-4 @error('bank_name') is-invalid @enderror"
                      name="bank_name" value="{{ @$user->userbank->name}}" autocomplete="bank_name" autofocus
                      placeholder="{{ trans('custom.name_of_bank') }}">
                    </div>
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                      <input id="acc_holder_name" type="text"
                       class="form-control grey-ph h-auto py-4 rounded-0 @error('acc_holder_name') is-invalid @enderror" name="acc_holder_name"
                       value="{{ @$user->userbank->account_holder }}" autocomplete="acc_holder_name" autofocus
                       placeholder="{{ trans('custom.name_account_holder') }}">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input id="bank_branch" type="text"
                      class="form-control grey-ph h-auto py-4 rounded-0 @error('bank_branch') is-invalid @enderror" name="bank_branch"
                      value="{{ @$user->userbank->branch }}" autocomplete="bank_branch" autofocus
                      placeholder="{{ trans('custom.bank_branch_only') }}">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input id="swift_code" type="text"
                      class="form-control grey-ph h-auto py-4 rounded-0 @error('swift_code') is-invalid @enderror" name="swift_code"
                      value="{{ @$user->userbank->swift_code }}" autocomplete="swift_code" autofocus
                      placeholder="{{ trans('custom.swift_code') }}">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input id="acc_number" type="text"
                      class="form-control grey-ph h-auto py-4 rounded-0 @error('acc_number') is-invalid @enderror" name="acc_number"
                      value="{{ @$user->userbank->account_number }}" autocomplete="acc_number" autofocus
                      placeholder="{{ trans('custom.account_number') }}">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      {!! Form::select('bank_country_id',$country,old('bank_country_id', @$user->userbank->bank_country_id),['class'=>'form-control h-auto py-4','placeholder'=>trans('custom.select_country'),'id'=>'country_id']) !!}
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE ACCOUNT <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
                <div id="menu2" class="tab-pane">
                  {!! Form::open(['route' => 'nft-wallet-address-update','enctype' => 'multipart/form-data','id'=>'nft-wallet-address-upadte', 'method'=>'POST'])!!}
                  <div class="row">
                    <input name="id" type="hidden" class="form-control blue-ph h-auto py-4" value="{{ $user->id }}">
                    <div class="col-12 col-md-6">
                      {!! Form::text('nft_wallet_address', old('nft_wallet_address', @$user->nft_wallet_address), ['class' => 'form-control blue-ph h-auto py-4', 'placeholder' => 'Enter NFT Wallete Address']) !!}
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4"></div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE ACCOUNT <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="profile-upload" aria-hidden="true" style="display: none;" id="profile-upload">
              <div class="modal-dialog  modal-dialog-centered">
                  <div class="modal-content  text-white">
                      <div class="modal-header d-block ">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h5 class="modal-title mt-0">Upload Profile Image</h5>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  {{Form::open(['route' => 'updateImage','id' =>'profile-image-update','enctype' => 'multipart/form-data'])}}
                                  <div class="image-editor m-auto">
                                      <div class="cropit-preview"></div>
                                      <div class="image-size-label">Resize Image</div>
                                      <!-- <input type="range" class="cropit-image-zoom-input mt-2 mb-2 w-100  "> -->
                                      <input type="file" class="cropit-image-input d-none">
                                      <input type="hidden" class="image-value" name="profile_image"/>
                                      <button class="btn btn-info btn-sm float-left btn-f" type="button">Choose File</button>
                                      <button class="btn btn-success  btn-sm  float-right">Submit</button>
                                  </div>
                                  {{Form::close()}}
                              </div>
                          </div>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div>

@endsection