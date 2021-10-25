@extends('layouts.app')

@section('content')
<div class="content-wrapper">
	<div class="row align-items-center mt-5 pt-5">
		<div class="col-12 col-md-6">
			<img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1044-2x.png') }}" class="img-fluid" alt="">
		</div>
		<div class="col-12 col-md-6 text-white mt-4 mt-md-0">
			<h2>BULL KONG #7097</h2>
			<p class="font-12 w-75 mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id mi imperdiet,
				tempus est ut, efficitur enim. Vivamus mattis ante non risus sollicitudin
				consectetur. Quisque dapibus tortor non lectus luctus, volutpat faucibus nulla
			ullamcorper</p>
			<h3 class="mt-3">0.001 $USD</h3>
			<div class="row justfy-content-between align-items-center mt-4">
				<div class="col-12 col-xl-8">
					<input type="text" class="py-3 form-control h-auto py-4" placeholder="Security Password">
				</div>
				<div class="col-12 col-xl-4 mt-4 mt-lg-0">
					<button class="btn bg-warning text-white p-4 rounded-0">BUY NOW <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-2 d-inline align-middle w-25" alt=""></button>
				</div>
			</div>
			<p class="border-top border-white mt-4"></p>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12">
			<p class="text-white pb-3">Trading History</p>
		</div>
		<div class="col-12 col-md-6">
			<table class="table table-dark trading-table text-center">
				<thead class="table-gradient">
					<tr>
						<th>AMOUNT</th>
						<th>DATE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>$20,000</td>
						<td>12/09/2021</td>
					</tr>
					<tr>
						<td>$20,000</td>
						<td>12/09/2021</td>
					</tr>
					<tr>
						<td>$20,000</td>
						<td>12/09/2021</td>
					</tr>
					<tr>
						<td>$20,000</td>
						<td>12/09/2021</td>
					</tr>
					<tr>
						<td>$20,000</td>
						<td>12/09/2021</td>
					</tr>
					<tr>
						<td>$20,000</td>
						<td>12/09/2021</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-12 col-md-6 mt-4 mt-md-0">
			<h4 class=" text-white">Terms & Conditions</h4>
			<ul class="text-secondary mt-4">
				<li class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
				labore et dolore magna aliqua.</li>
				<li class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
				labore et dolore magna aliqua.</li>
				<li class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
				labore et dolore magna aliqua.</li>
				<li class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
				labore et dolore magna aliqua.</li>
			</ul>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12">
			<p class="text-white pb-3">Other Bull Kong’s Collection</p>
		</div>
		<div class="col-12">
			<div class="bull-kong-slider">
				<div>
					<div class="bg-white p-3 rounded mx-2">
						<img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1044.png') }}" class="img-fluid mx-auto" alt="">
						<div class="mt-3">
							<h4 class="text-blue font-weight-bold">BULL KONG #7097</h4>
						</div>
					</div>
				</div>
				<div>
					<div class="bg-white p-3 rounded mx-2">
						<img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1045.png') }}" class="img-fluid mx-auto" alt="">
						<div class="mt-3">
							<h4 class="text-blue font-weight-bold">KONG #7097</h4>
						</div>
					</div>
				</div>
				<div>
					<div class="bg-white p-3 rounded mx-2">
						<img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1046.png') }}" class="img-fluid mx-auto" alt="">
						<div class="mt-3">
							<h4 class="text-blue font-weight-bold">KONG BOSS#7097</h4>
						</div>
					</div>
				</div>
				<div>
					<div class="bg-white p-3 rounded mx-2">
						<img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1047.png') }}" class="img-fluid mx-auto" alt="">
						<div class="mt-3">
							<h4 class="text-blue font-weight-bold">BULL KONG #7097</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection