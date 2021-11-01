@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="row mt-5 pt-5">
   <div class="col-12 col-xl-12">

     @if(Session::has('success'))
     <div class="alert alert-success alert-dismissable">
       {{ Session::get('success') }}
     </div>
     @endif

     @if(Session::has('error'))
     <div class="alert alert-danger alert-dismissable">
       <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
       {{ Session::get('error') }}
     </div>
     @endif
   </div>
   <div class="col-12 col-xl-4 grid-margin stretch-card">
    <div class="card tale-bg overflow-hidden bg-white pb-3">
      <div class="bg-warning p-4 pb-5">
        <h4 class="text-white pb-2">{{__('custom.my_profile')}}</h4>
      </div>
      <div class="px-4 cus-my-profile-img">
        <img src="{{$user->profile_image}}" class="rounded-circle img-fluid" alt="">
      </div>
      <div class="row px-4 mt-4">
        <div class="col-md-6">
          <h4 class="text-dark font-weight-bold mb-0">{{$user->name}}</h4>
          <span class="text-secondary font-12">{{trans('custom.full_name')}}</span>
        </div>
       <!--  <div class="col-md-6">
          <h4 class="text-dark font-weight-bold mb-0">{{($user->rank) ? $user->rank->name : '-'}}</h4>
          <span class="text-secondary font-12">{{trans('custom.current_rank')}}</span>
        </div> -->
      </div>
      <div class="row px-4 mt-4">
        <div class="col-md-6">
          <h4 class="text-secondary mb-0">{{$user->email}}</h4>
          <span class="text-secondary font-12">{{trans('custom.email')}}</span>
        </div>
        <div class="col-md-6">
          <h4 class="text-secondary mb-0">{{$user->phone_number}}</h4>
          <span class="text-secondary font-12">{{trans('custom.phone_number')}}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-xl-8">
    <div class="dashboard-slider">
      @foreach($sliders as $slider)

      <div class="position-relative">
        <img src="{{ $slider->image }}" class="img-fluid min-height-280" alt="">
        <div class="text-center text-white NFT-collection">
          <!-- <h4>LAUNCHING SOON</h4>
            <h3>NFT COLLECTIONS</h3> -->
            <button class="btn bg-transparent text-warning border-warning px-3 rounded-0 font-10 mt-2">{{__('custom.explore')}} <img src="{{ $slider->url }}" class="img-fluid ml-2 d-inline align-middle" alt=""></button>
          </div>
        </div>
        @endforeach
      <!-- <div class="position-relative">
        <img src="{{ asset('assets/images/assets/Dashboard/Group912.png') }}" class="img-fluid min-height-280" alt="">
        <div class="text-center text-white NFT-collection">
          <h4>LAUNCHING SOON</h4>
          <h3>NFT COLLECTIONS</h3>
          <button class="btn bg-transparent text-warning border-warning px-3 rounded-0 font-10 mt-2">EXPLORE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></button>
        </div>
      </div>
      <div class="position-relative">
        <img src="{{ asset('assets/images/assets/Dashboard/Group912.png') }}" class="img-fluid min-height-280" alt="">
        <div class="text-center text-white NFT-collection">
          <h4>LAUNCHING SOON</h4>
          <h3>NFT COLLECTIONS</h3>
          <button class="btn bg-transparent text-warning border-warning px-3 rounded-0 font-10 mt-2">EXPLORE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></button>
        </div>
      </div> -->
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <p class="text-white">{{__('custom.staking_solutions')}}</p>
  </div>
  <div class="col-12">
    <div class="stacking-slider">
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
          <h3 class="text-white font-weight-bold">{{$stakingpool->stacking_display_start}}% - {{$stakingpool->stakeing_display_end}}%</h3>
          
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
<div class="row mt-5">
  <div class="col-12">
    <p class="text-white">{{__('custom.last_nfts')}}</p>
  </div>
  @foreach($nft_cats as $category)
  <div class="col-12 col-md-6 col-lg-4">
    <div class="bg-bullkong rounded d-flex align-items-end px-4 py-3 text-white" style="background-image:url({{$category->image}})">
      <h3>{{$category->name}}</h3>
    </div>
  </div>
  @endforeach
  <!-- <div class="col-12 col-md-6 col-lg-4 mt-4 mt-md-0">
    <div class="bg-newface rounded d-flex align-items-end px-4 py-3 text-white">
      <h3>NEW FACE #087</h3>
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
    <div class="bg-hoppertrophy rounded d-flex align-items-end px-4 py-3 text-white">
      <h3>#36 HOPPER - TROPHY</h3>
    </div>
  </div> -->
</div>
<div class="row mt-5">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body p-4">
        <div class="row pt-2">
          <div class="col-12 col-md-6">
            <h4 class="text-grey">{{__('custom.earning_breakdown')}}</h4>
          </div>
          <div class="col-12 col-md-6 text-md-right pr-xl-5">
            <span class="text-grey d-flex align-items-center justify-content-end font-12">ROI <h4 class="font-weight-bold text-pink mb-0 ml-4">$20,000</h4></span>
            <span class="text-grey d-flex align-items-center justify-content-end font-12 mt-1">{{__('custom.direct_refferal')}} <h4 class="font-weight-bold text-violate mb-0 ml-4">$40,000</h4></span>
            <span class="text-grey d-flex align-items-center justify-content-end font-12 mt-1">{{__('custom.pairing')}} <h4 class="font-weight-bold text-success mb-0 ml-4">$20,000</h4></span>
          </div>
          <div class="col-12">
            <img src="{{ asset('assets/images/assets/Dashboard/Group1052.png') }}" class="img-fluid h-350" alt="logo"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body p-4">
        <div class="row pt-2">
          <div class="col-12 col-md-6">
            <h4 class="text-grey">{{__('custom.commission_breakdown')}}</h4>
          </div>
          <div class="col-12 col-md-6 text-md-right">
            <select class="rounded-0 font-weight-bold border-violate font-12 p-2 px-3">
              <option value="">{{__('custom.this_month')}}</option>
            </select>
          </div>
          <div class="col-12 text-center mt-3">
            <img src="{{ asset('assets/images/assets/Dashboard/Group1056.png') }}" class="img-fluid" alt="logo"/>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12 col-md-4 text-center mt-3">
            <p class="d-flex align-items-center justify-content-center mb-0 text-grey"><span class="count bg-pink d-block mr-2"></span>ROI</p>
            <h4 class="text-black font-weight-bold mt-2">${{($user->userwallet) ? number_format($user->userwallet->yield_wallet,2) : '' }}</h4>
          </div>
          <div class="col-12 col-md-4 text-center mt-3">
            <p class="d-flex align-items-center justify-content-center mb-0 text-grey"><span class="count bg-violate d-block mr-2"></span>{{__('custom.direct_refferal')}}</p>
            <h4 class="text-black font-weight-bold mt-2">${{($user->userwallet) ? number_format($user->userwallet->referral_commission,2):''}}</h4>
          </div>
          <div class="col-12 col-md-4 text-center mt-3">
            <p class="d-flex align-items-center justify-content-center mb-0 text-grey"><span class="count bg-success d-block mr-2"></span>{{__('custom.pairing')}}</p>
            <h4 class="text-black font-weight-bold mt-2">${{($user->userwallet) ? number_format($user->userwallet->pairing_commission,2):''}}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row p-3">
          <div class="col-12 pb-4">
            <h4>{{__('custom.trading_news')}}</h4>
          </div>
          @if($news != null)
          @foreach($news as $key => $value)
          @if($key  == 0)
          <div class="col-12 col-xl-7">
            <div class="bg-news p-4 d-flex flex-column justify-content-end" style="background-image: url({{$value->image}});">
              <h5 class="text-white">{{__('custom.news')}}</h5>
              <h3 class="text-white">{!! \Illuminate\Support\Str::limit($value->title,50) !!}</h3>
              <p class="text-white font-12">{!! \Illuminate\Support\Str::limit($value->details,100) !!}</p>
            </div>
          </div>
          @else
          @if($key == 1)
          <div class="col-12 col-xl-5 mt-4 mt-xl-0">
            @endif
            <div class="d-flex align-items-center {{($key > 1) ? 'mt-3' : '' }}">
              <div>
                <img src="{{$value->image}}" class="img-fluid" alt="">
              </div>
              <div class="ml-3 border-bottom pb-3">
                <p class="font-12 mb-1">{!! \Illuminate\Support\Str::limit($value->title,50) !!}</p>
                <h5 class="font-weight-bold">{!! \Illuminate\Support\Str::limit($value->details,50) !!}</h5>
              </div>
            </div>
            <!-- <div class="d-flex align-items-center mt-3">
              <div>
                <img src="{{ asset('assets/images/assets/Dashboard/Group898.png') }}" class="img-fluid" alt="">
              </div>
              <div class="ml-3 border-bottom pb-3">
                <p class="font-12 mb-1">NEWS</p>
                <h5 class="font-weight-bold">These are the major companies that accept
                crypto as payment</h5>
              </div>
            </div>
            <div class="d-flex align-items-center mt-3">
              <div>
                <img src="{{ asset('assets/images/assets/Dashboard/Group900.png') }}" class="img-fluid" alt="">
              </div>
              <div class="ml-3 border-bottom pb-3">
                <p class="font-12 mb-1">NEWS</p>
                <h5 class="font-weight-bold">These are the major companies that accept
                crypto as payment</h5>
              </div>
            </div>
            <div class="d-flex align-items-center mt-3">
              <div>
                <img src="{{ asset('assets/images/assets/Dashboard/Group902.png') }}" class="img-fluid" alt="">
              </div>
              <div class="ml-3 border-bottom pb-3">
                <p class="font-12 mb-1">NEWS</p>
                <h5 class="font-weight-bold">These are the major companies that accept
                crypto as payment</h5>
              </div>
            </div> -->
            @if($key  == (count($news) -1 ))
          </div>
          @endif
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-12">
    <div class="row">
      <div class="col-12 col-md-6 col-xl-3">
        <div class="card bg-crypto-wallet">
          <div class="card-body text-white">
            <p class="mb-4">{{__('custom.crypto_wallet')}} </p>
            <p class="fs-30 mb-2">${{($user->userwallet) ? number_format($user->userwallet->crypto_wallet,2) : '' }}</p>
            <p class="font-10">{{__('custom.balance')}}</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mt-4 mt-md-0">
        <div class="card bg-yield-wallet">
          <div class="card-body text-white">
            <p class="mb-4">{{__('custom.yield_wallet')}}  </p>
            <p class="fs-30 mb-2">${{($user->userwallet) ? number_format($user->userwallet->  yield_wallet,2) : '' }}</p>
            <p class="font-10">{{__('custom.balance')}}</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mt-4 mt-xl-0">
        <div class="card bg-commission-wallet">
          <div class="card-body text-white">
            <p class="mb-4">{{__('custom.commission_wallet')}}  </p>
            <p class="fs-30 mb-2">${{($user->userwallet) ? number_format($user->userwallet->commission_wallet,2) : '' }}</p>
            <p class="font-10">{{__('custom.balance')}}</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mt-4 mt-xl-0">
        <div class="card bg-NFT-wallet">
          <div class="card-body text-white">
            <p class="mb-4">{{__('custom.nft_wallet')}}  </p>
            <p class="fs-30 mb-2">${{($user->userwallet) ? number_format($user->userwallet->nft_wallet,2) : '' }}</p>
            <p class="font-10">{{__('custom.balance')}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
@if($planExpired)
@foreach($expired_stacking_pools as $stacking_pool)
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="points-alert" aria-hidden="true" style="display: none;" id="planExpired{{$stacking_pool->id}}" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content cus-blue-bg">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><span class="mdi mdi-alert"></span> {{trans('custom.staking_popup_title')}}</h5>
            </div>
            <div class="modal-body">
                <div class="font-16">
                    <?php $text = str_replace('#link',route('stakepool',$stacking_pool->stacking_pool_package_id),str_replace(':Stock',$stacking_pool->name_en,str_replace(':Date', $stacking_pool->end_date,str_replace(':Month', $stacking_pool->staking_period, trans('custom.plan_expired'))))); ?>
                    {!! $text !!}
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endforeach
@endif
@endsection
