 @extends('layouts.app')
@section('title', __('custom.staking_pool'))
@section('page_title', __('custom.staking_pool'))
 @section('content')
 <div class="content-wrapper">
  <div class="row align-items-center mt-5 pt-5">
    <div class="col-12 col-xl-5">
      <div class="card">
        <div class="card-body">
          <div class="row px-md-4 py-2">
            <div class="col-12 col-md-4">
              <h1 class="text-violate border-violate rounded-circle font-weight-bold text-center alpha-symbol">{{substr($stakingpool->name,0,1)}}</h1>
            </div>
            <div class="col-12 col-md-8">
              <h3 class="text-blue font-weight-bold">{{$stakingpool->name}}</h3>
            </div>
            <div class="col-12 mt-2">
              <p class="font-12">{{$stakingpool->description}}</p>
            </div>
            <div class="col-12 col-md-6">
              <p class="border-violate my-3"></p>
            </div>
            <div class="col-12 col-md-7">
              <p class="text-blue font-12 font-weight-bold">{{__('custom.expected_anual_rate')}}</p>
              <h3 class="text-blue font-weight-bold mt-2">{{$stakingpool->stacking_display_start}}% - {{$stakingpool->stacking_display_end}}%</h3>
            </div>
            @if($totalInvested > 0)
            <div class="col-12 col-md-5 px-xl-0">
              <p class="text-blue font-12 font-weight-bold">{{str_replace('<br>','',__('custom.invested_amount'))}}</p>
              <button class="btn bg-blue text-white rounded-0 w-100">${{number_format($totalInvested,2)}}</button>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-7 text-white mt-4 mt-xl-0">
      <div class="row text-white">
        <div class="col-12">
          <p>Coin Price</p>
        </div>
        @foreach($stakingpool->stackingpoolcoins as $coin)
        <div class="col-12 col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="{{ asset('images/assets/Artboard2_copy5/Rectangle385.png') }}" class="img-fluid w-70" alt="">
              <h4>{{$coin->name}}</h4>
            </div>
            <div>
              <h3>${{$coin->price}}</h3>
            </div>
          </div>
          <p class="border-bottom border-white"></p>
        </div>
        @endforeach
        <!-- <div class="col-12 col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="{{ asset('images/assets/Artboard2_copy5/Rectangle385.png') }}" class="img-fluid w-70" alt="">
              <h4>COIN ONE</h4>
            </div>
            <div>
              <h3>13.21%</h3>
            </div>
          </div>
          <p class="border-bottom border-white"></p>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="{{ asset('images/assets/Artboard2_copy5/Rectangle385.png') }}" class="img-fluid w-70" alt="">
              <h4>COIN ONE</h4>
            </div>
            <div>
              <h3>13.21%</h3>
            </div>
          </div>
          <p class="border-bottom border-white"></p>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="{{ asset('images/assets/Artboard2_copy5/Rectangle385.png') }}" class="img-fluid w-70" alt="">
              <h4>COIN ONE</h4>
            </div>
            <div>
              <h3>13.21%</h3>
            </div>
          </div>
          <p class="border-bottom border-white"></p>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="{{ asset('images/assets/Artboard2_copy5/Rectangle385.png') }}" class="img-fluid w-70" alt="">
              <h4>COIN ONE</h4>
            </div>
            <div>
              <h3>13.21%</h3>
            </div>
          </div>
          <p class="border-bottom border-white"></p>
        </div>
        <div class="col-12 col-md-6">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <img src="{{ asset('images/assets/Artboard2_copy5/Rectangle385.png') }}" class="img-fluid w-70" alt="">
              <h4>COIN ONE</h4>
            </div>
            <div>
              <h3>13.21%</h3>
            </div>
          </div>
          <p class="border-bottom border-white"></p>
        </div> -->
      </div>
    </div>
  </div>
  <hr class="border-white mt-5" />
  <div class="row mt-5">
    <div class="col-12 col-xl-4">
      <div>
        <p class="text-white pb-3">{{__('custom.staking_history')}}</p>
      </div>
      <div class="table-responsive table-history">
        @include('stacking_pool.stack_history')
      </div>

    </div>
    <div class="col-12 col-xl-8 mt-4 mt-xl-0 pl-xl-5">
      <div>
        <p class="text-white pb-3">{{__('custom.stake_now')}}</p>
      </div>
      <form method="post" action="{{ route('staking_pool') }}" id="staking_pool">
        @csrf
        <div class="row align-items-center bg-warning px-3 py-4 rounded">
          <div class="col-12 col-md-12">
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
         <div class="col-12 col-md-7">
          <input type="hidden" name="stacking_pool_package_id" value="{{$stakingpool->id}}">
          <input type="text" name="amount" class="form-control h-auto py-4" placeholder="{{__('custom.stake_amount')}}">
          @error('amount')
          <span class="invalid-feedback" role="alert">
           <strong>{{ $message }}</strong>
         </span>
         @enderror
       </div>
       <div class="col-12 col-md-5 mt-3 mt-md-0">
        <h3 class="font-weight-bold"><span class="font-12">Available Fund:</span> ${{($user->userwallet) ? number_format($user->userwallet->crypto_wallet,2) : '0.00' }}</h3>
      </div>
      <div class="col-12 col-md-7 mt-3">
        <input name="security_password" id="security_password" type="password" class="form-control h-auto py-4" placeholder="{{ trans('custom.security_password') }}">
        @error('secure_password')
        <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
       </span>
       @enderror
     </div>
     <div class="col-12 col-md-5 mt-3">
      <select name="duration" id="duration" class="form-control h-auto py-4">
        <option value="">{{__('custom.duration_term')}}</option>
        <option value="12">12 {{__('custom.months')}}</option>
        <option value="24">24 {{__('custom.months')}}</option>
        @error('duration')
        <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
       </span>
       @enderror
     </select>
   </div>
   <div class="col-12 mt-3">
    <button class="btn bg-white text-warning p-4 rounded-0 w-100 text-uppercase">{{__('custom.stake')}} <img src="{{ asset('images/assets/Dashboard/Group930.png') }}" class="img-fluid d-inline align-middle ml-4" alt=""></button>
  </div>
</div>
</form>
</div>
</div>
@foreach($user_investments as $user_investment)

@endforeach
@endsection
@section('scripts')
<script src="{{ asset('assets/js/custom/stacking_pool.js').'?v='.time() }}"></script>
<script type="text/javascript">
  
</script>

@endsection
