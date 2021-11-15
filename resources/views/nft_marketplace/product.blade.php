@extends('layouts.app')
@section('title', __('custom.nft_marketplace'))
@section('page_title', __('custom.nft_marketplace'))
@section('content')
<div class="content-wrapper">
	<div class="row align-items-center mt-5 pt-5">
		<div class="col-12 col-md-6">
			<img src="{{ asset('uploads/nft-product/'.$product->image) }}" class="img-fluid" alt="">
		</div>
		<div class="col-12 col-md-6 text-white mt-4 mt-md-0">
			<h2>{{ $product->name }} #{{ $product->id }}</h2>
			<p class="font-12 w-75 mt-3">{{ $product->description }}</p>
			<h3 class="mt-3">{{ $product->price }} $USD</h3>
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
			@if($checkProduct == 0)
			<form method="post" action="{{ route('purchase-product') }}" id="purchase_product">
				@csrf
				<div class="row justfy-content-between align-items-center mt-4">
					<div class="col-12 col-xl-8">
						<input type="hidden" name="product_id" value="{{ $product->id }}">
						<input type="hidden" name="amount" value="{{ $product->price }}">
						<input name="security_password" id="security_password" type="password" class="form-control h-auto py-4" placeholder="{{ trans('custom.security_password') }}">
						@error('secure_password')
						<span class="invalid-feedback" role="alert">
						  <strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-12 col-xl-4 mt-4 mt-lg-0">
						<button type="submit" class="btn bg-warning text-white p-4 rounded-0">{{ trans('custom.buy_now')}} <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></button>
					</div>
				</div>
			</form>	
			@endif
			<p class="border-top border-white mt-4"></p>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12">
			<p class="text-white pb-3">{{ trans('custom.trading_history')}}</p>
		</div>
		<div class="col-12 col-md-6">
			<div class="table-responsive table-history">
			  @include('nft_marketplace.nft_purchase_history')
			</div>
		</div>
		<div class="col-12 col-md-6 mt-4 mt-md-0">
			<h4 class=" text-white">{{ trans('custom.terms_conditions')}}</h4>
			{!!__('custom.nft_marketplace_tc')!!}
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12">
			<p class="text-white pb-3">{{ __('custom.other_collection')}}</p>
		</div>
		<div class="col-12">
			<div class="bull-kong-slider">
				@foreach($othrt_products as $value)
				<div>
					<a href="{{route('nftproduct', $value->id)}}">
					<div class="bg-white p-3 rounded mx-2">
						<img src="{{ asset('uploads/nft-product/'.$value->image) }}" class="img-fluid mx-auto" alt="">
						<div class="mt-3">
							<h4 class="text-blue font-weight-bold">{{ $value->name }} #{{ $value->id }}</h4>
						</div>
					</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	@endsection