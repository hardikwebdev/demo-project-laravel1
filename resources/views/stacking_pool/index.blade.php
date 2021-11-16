@extends('layouts.app')
@section('title', __('custom.staking_pools'))
@section('page_title', __('custom.staking_pools'))
@section('content')
    <div class="staking-main content-wrapper">
        <div class="ml-2 mb-4 d-none-desk d-md-block">
            <h2 class="text-warning font-weight-bold">@yield('page_title','Dashboard')</h2>
            @if (Route::currentRouteName() == 'dashboard')
                <p class="text-white">{{ str_replace('#name', auth()->user()->name, __('custom.wc_text')) }}</p>
            @endif
        </div>
        <div class="row">
            <?php $i = 1;
            $j = 1; ?>
            <div class="row w-100">
                @foreach ($staking_pool as $stackingpool)
                    @if ($i == 1)
                        <div class="col-12 col-md-3 mt-5">
                            <div class="bg-card-4 text-center p-4 rounded">
                                <img src="{{ $stackingpool->symbol }}" class="img-fluid alpha-top-img" alt="">
                                <h4 class="text-blue font-weight-bold">{{ $stackingpool->name }}</h4>
                                <p class="border-top border-blue mt-3 mx-auto"></p>
                                <p class="text-secondary font-12">{{ __('custom.expected_anual_rate') }}</p>
                                <h3 class="text-blue font-weight-bold">{{ $stackingpool->stacking_display_start }}% -
                                    {{ $stackingpool->stacking_display_end }}%</h3>
                                <div><img class="stake-logo" src="{{ $stackingpool->image }}"
                                        class="img-fluid alpha-bottom-img mt-4" alt="" style="width: 30px;height:30px;">
                                </div>
                                @if ($stackingpool->investedAmount > 0)
                                    <div class="d-flex justify-content-around mt-2">
                                        <p class="text-dark font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                        <button
                                            class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
                                    </div>
                                    <a class="btn bg-warning text-white px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                    <a class="btn bg-warning text-white px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle" alt=""></a>

                                @endif
                            </div>
                        </div>
                        <!--  <div class="col-12 col-md-6 col-xl-4 @if ($j > 4) mt-5 pt-md-5 @endif">
          <div class="bg-card-1 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold" style="font-size: 40px;">{{ $stackingpool->name }}</h4>
            {{-- <p class="text-white font-12">{!! \Illuminate\Support\Str::limit($stackingpool->description,50) !!}</p> --}}
            <p class="border-top border-white mt-4 w-75 mx-auto"></p>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">{{ $stackingpool->stacking_display_start }}% - {{ $stackingpool->stacking_display_end }}%</h3>
             @if ($stackingpool->investedAmount > 0)
            <div class="d-flex justify-content-around mt-2">
              <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
              <button class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
            </div>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-4-btn" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
        @else
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
            @endif
          </div>
        </div> -->
                    @elseif($i == 2)
                        <div class="col-12 col-md-3 mt-5">
                            <div class="bg-card-2 text-center p-4 rounded">
                                <img src="{{ $stackingpool->symbol }}" class="img-fluid alpha-top-img" alt="">
                                <h4 class="text-white font-weight-bold">{{ $stackingpool->name }}</h4>
                                <p class="border-top border-white mt-3 mx-auto"></p>
                                <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
                                <h3 class="text-blue font-weight-bold">{{ $stackingpool->stacking_display_start }}% -
                                    {{ $stackingpool->stacking_display_end }}%</h3>
                                <div><img class="stake-logo" src="{{ $stackingpool->image }}"
                                        class="img-fluid alpha-bottom-img mt-4" alt="" style="width: 30px;height:30px;">
                                </div>
                                @if ($stackingpool->investedAmount > 0)
                                    <div class="d-flex justify-content-around mt-2">
                                        <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                        <button
                                            class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
                                    </div>
                                    <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                    <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle" alt=""></a>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="col-12 col-md-6 col-xl-4 mt-5 @if ($j > 4) pt-md-5 @else  mt-md-0 @endif">
          <div class="bg-card-2 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold" style="font-size: 40px;">{{ $stackingpool->name }}</h4>
            {{-- <p class="text-white font-12">{!! \Illuminate\Support\Str::limit($stackingpool->description,50) !!}</p> --}}
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">{{ $stackingpool->stacking_display_start }}% - {{ $stackingpool->stacking_display_end }}%</h3>
            @if ($stackingpool->investedAmount > 0)
            <div class="d-flex justify-content-around mt-2">
              <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
              <button class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
            </div>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-4-btn" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
        @else
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
            @endif
          </div>
        </div> -->
                    @elseif($i == 3)
                        <div class="col-12 col-md-3 mt-5">
                            <div class="bg-card-3 text-center p-4 rounded">
                                <img src="{{ $stackingpool->symbol }}" class="img-fluid alpha-top-img" alt="">
                                <h4 class="text-white font-weight-bold">{{ $stackingpool->name }}</h4>
                                <p class="border-top border-white mt-3 mx-auto"></p>
                                <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
                                <h3 class="text-blue font-weight-bold">{{ $stackingpool->stacking_display_start }}% -
                                    {{ $stackingpool->stacking_display_end }}%</h3>
                                <div><img class="stake-logo" src="{{ $stackingpool->image }}"
                                        class="img-fluid alpha-bottom-img mt-4" alt="" style="width: 30px;height:30px;">
                                </div>
                                @if ($stackingpool->investedAmount > 0)
                                    <div class="d-flex justify-content-around mt-2">
                                        <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                        <button
                                            class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
                                    </div>
                                    <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                    <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle" alt=""></a>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="col-12 col-md-6 col-xl-4 mt-5 @if ($j > 4) pt-md-5 @else  mt-xl-0 pt-md-5 pt-xl-0 @endif">
          <div class="bg-card-3 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold" style="font-size: 40px;">{{ $stackingpool->name }}</h4>
            {{-- <p class="text-white font-12">{!! \Illuminate\Support\Str::limit($stackingpool->description,50) !!}</p> --}}
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">{{ $stackingpool->stacking_display_start }}% - {{ $stackingpool->stacking_display_end }}%</h3>
            @if ($stackingpool->investedAmount > 0)
            <div class="d-flex justify-content-around mt-2">
              <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
              <button class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
            </div>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-4-btn" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
        @else
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
            @endif
          </div>
        </div> -->
                    @elseif($i == 4)
                        <div class="col-12 col-md-3 mt-5">
                            <div class="bg-card-1 text-center p-4 rounded">
                                <img src="{{ $stackingpool->symbol }}" class="img-fluid alpha-top-img" alt="">
                                <h4 class="text-white font-weight-bold">{{ $stackingpool->name }}</h4>
                                <p class="border-top border-white mt-3 mx-auto"></p>
                                <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
                                <h3 class="text-blue font-weight-bold">{{ $stackingpool->stacking_display_start }}% -
                                    {{ $stackingpool->stacking_display_end }}%</h3>
                                <div><img class="stake-logo" src="{{ $stackingpool->image }}"
                                        class="img-fluid alpha-bottom-img mt-4" alt="" style="width: 30px;height:30px;">
                                </div>
                                @if ($stackingpool->investedAmount > 0)
                                    <div class="d-flex justify-content-around mt-2">
                                        <p class="text-white font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
                                        <button
                                            class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
                                    </div>
                                    <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
                                @else
                                    <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2"
                                        href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img
                                            src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}"
                                            class="img-fluid ml-2 d-inline align-middle" alt=""></a>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="col-12 col-md-6 col-xl-4 mt-5 pt-md-5">
          <div class="bg-card-4 text-center p-4 pb-5 rounded position-relative">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="font-weight-bold" style="font-size: 40px;">{{ $stackingpool->name }}</h4>
            {{-- <p class="font-12">{!! \Illuminate\Support\Str::limit($stackingpool->description,50) !!}</p> --}}
            <hr/>
            <p class="text-blue font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-blue font-weight-bold">{{ $stackingpool->stacking_display_start }}% - {{ $stackingpool->stacking_display_end }}%</h3>
            @if ($stackingpool->investedAmount > 0)
            <div class="d-flex justify-content-around mt-2">
              <p class="text-dark font-weight-bold font-12">{!! __('custom.invested_amount') !!}</p>
              <button class="btn bg-blue text-white rounded-0 px-4">${{ number_format($stackingpool->investedAmount, 2) }}</button>
            </div>
            <a class="btn bg-warning text-white px-3 rounded-0 font-10 mt-2 card-4-btn" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></a>
        @else
            <a class="btn bg-warning text-white px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', $stackingpool->id) }}">{{ __('custom.stake') }} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>

            @endif
          </div>
        </div> -->
                    @endif
                    <?php
                    $i++;
                    $j++;
                    if ($i == 5) {
                        $i = 1;
                    }
                    ?>

                @endforeach
                <!--  <div class="col-12 col-md-6 col-xl-4 mt-5 pt-md-5">
          <div class="bg-card-1 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold">ALPHA</h4>
            <p class="text-white font-12">The Cosmos Hub keeps track of balances and
              routes transactions through the internet of
            blockchains.</p>
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">5% - 10%</h3>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', 1) }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-5 pt-md-5">
          <div class="bg-card-2 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold">ALPHA</h4>
            <p class="text-white font-12">The Cosmos Hub keeps track of balances and
              routes transactions through the internet of
            blockchains.</p>
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">5% - 10%</h3>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', 1) }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-5 pt-md-5">
          <div class="bg-card-1 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold">ALPHA</h4>
            <p class="text-white font-12">The Cosmos Hub keeps track of balances and
              routes transactions through the internet of
            blockchains.</p>
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">5% - 10%</h3>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', 1) }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-5 pt-md-5">
          <div class="bg-card-2 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold">ALPHA</h4>
            <p class="text-white font-12">The Cosmos Hub keeps track of balances and
              routes transactions through the internet of
            blockchains.</p>
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">5% - 10%</h3>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', 1) }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-5 pt-md-5">
          <div class="bg-card-3 text-center p-4 pb-5 rounded">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top w-300" alt="">
            <h4 class="text-white font-weight-bold">ALPHA</h4>
            <p class="text-white font-12">The Cosmos Hub keeps track of balances and
              routes transactions through the internet of
            blockchains.</p>
            <hr/>
            <p class="text-white font-12">{{ __('custom.expected_anual_rate') }}</p>
            <h3 class="text-white font-weight-bold">5% - 10%</h3>
            <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stakepool', 1) }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
          </div>
        </div> -->
            </div>
        @endsection
