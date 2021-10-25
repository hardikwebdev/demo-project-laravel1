@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="row mt-5 pt-5">
    <div class="col-12 col-xl-4 grid-margin stretch-card">
      <div class="card tale-bg overflow-hidden bg-white pb-3">
        <div class="bg-warning p-4 pb-5">
          <h4 class="text-white pb-2">My profile</h4>
      </div>
      <div class="px-4 cus-my-profile-img">
          <img src="{{ asset('assets/images/assets/Dashboard/Group853.png') }}" class="rounded-circle img-fluid" alt="">
      </div>
      <div class="row px-4 mt-4">
          <div class="col-md-6">
              <h4 class="text-dark font-weight-bold mb-0">Andy John</h4>
              <span class="text-secondary font-12">Full name</span>
          </div>
          <div class="col-md-6">
            <h4 class="text-dark font-weight-bold mb-0">Gold</h4>
            <span class="text-secondary font-12">Rank</span>
        </div>
    </div>
    <div class="row px-4 mt-4">
      <div class="col-md-6">
          <h4 class="text-secondary mb-0">andy@outlook.com</h4>
          <span class="text-secondary font-12">Email</span>
      </div>
      <div class="col-md-6">
        <h4 class="text-secondary mb-0">+6012355678</h4>
        <span class="text-secondary font-12">Phone number</span>
    </div>
</div>
</div>
</div>
<div class="col-12 col-xl-8">
  <div class="dashboard-slider">
    <div class="position-relative">
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
</div>
<div class="position-relative">
  <img src="{{ asset('assets/images/assets/Dashboard/Group912.png') }}" class="img-fluid min-height-280" alt="">
  <div class="text-center text-white NFT-collection">
    <h4>LAUNCHING SOON</h4>
    <h3>NFT COLLECTIONS</h3>
    <button class="btn bg-transparent text-warning border-warning px-3 rounded-0 font-10 mt-2">EXPLORE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></button>
</div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-12">
      <p class="text-white">Stacking Solutions</p>
  </div>
  <div class="col-12">
      <div class="stacking-slider">
        <div>
          <div class="bg-card-1 text-center p-4 pb-5 rounded mx-2">
            <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
            <h4 class="text-white">ALPHA</h4>
            <p class="text-white font-12">The Cosmos Hub keeps track of balances and
              routes transactions through the internet of
          blockchains.</p>
          <hr/>
          <p class="text-white font-12">Expected Annual Reward Rate</p>
          <h3 class="text-white font-weight-bold">5% - 10%</h3>
          <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stackpool') }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
      </div>
  </div>
  <div>
      <div class="bg-card-2 text-center p-4 pb-5 rounded mx-2">
        <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
        <h4 class="text-white">ALPHA</h4>
        <p class="text-white font-12">The Cosmos Hub keeps track of balances and
          routes transactions through the internet of
      blockchains.</p>
      <hr/>
      <p class="text-white font-12">Expected Annual Reward Rate</p>
      <h3 class="text-white font-weight-bold">5% - 10%</h3>
      <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stackpool') }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
  </div>
</div>
<div>
  <div class="bg-card-3 text-center p-4 pb-5 rounded mx-2">
    <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
    <h4 class="text-white">ALPHA</h4>
    <p class="text-white font-12">The Cosmos Hub keeps track of balances and
      routes transactions through the internet of
  blockchains.</p>
  <hr/>
  <p class="text-white font-12">Expected Annual Reward Rate</p>
  <h3 class="text-white font-weight-bold">5% - 10%</h3>
  <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stackpool') }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
</div>
</div>
<div>
  <div class="bg-card-4 text-center p-4 pb-5 rounded mx-2 position-relative">
    <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
    <h4>ALPHA</h4>
    <p class="font-12">The Cosmos Hub keeps track of balances and
      routes transactions through the internet of
  blockchains.</p>
  <hr/>
  <p class="text-blue font-12">Expected Annual Reward Rate</p>
  <h3 class="text-blue font-weight-bold">5% - 10%</h3>
  <div class="d-flex justify-content-around mt-2">
      <p class="text-dark font-weight-bold font-12">Invested <br/> Amounts</p>
      <button class="btn bg-blue text-white rounded-0 px-4">$20,000</button>
  </div>
  <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2 card-4-btn" href="{{ route('stackpool') }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
</div>
</div>
<div>
  <div class="bg-card-1 text-center p-4 pb-5 rounded mx-2">
    <img src="{{ asset('assets/images/assets/Dashboard/Group929.png') }}" class="img-fluid card-img-top" alt="">
    <h4 class="text-white">ALPHA</h4>
    <p class="text-white font-12">The Cosmos Hub keeps track of balances and
      routes transactions through the internet of
  blockchains.</p>
  <hr/>
  <p class="text-white font-12">Expected Annual Reward Rate</p>
  <h3 class="text-white font-weight-bold">5% - 10%</h3>
  <a class="btn bg-white text-warning px-3 rounded-0 font-10 mt-2" href="{{ route('stackpool') }}">STAKE <img src="{{ asset('assets/images/assets/Dashboard/Group930.png') }}" class="img-fluid ml-2 d-inline align-middle" alt=""></a>
</div>
</div>
</div>
</div>
</div>
<div class="row mt-5">
    <div class="col-12">
      <p class="text-white">Latest non-fungible token (NFT)</p>
  </div>
  <div class="col-12 col-md-6 col-lg-4">
      <div class="bg-bullkong rounded d-flex align-items-end px-4 py-3 text-white">
        <h3>BULL KONG #7097</h3>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-4 mt-4 mt-md-0">
  <div class="bg-newface rounded d-flex align-items-end px-4 py-3 text-white">
    <h3>NEW FACE #087</h3>
</div>
</div>
<div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
  <div class="bg-hoppertrophy rounded d-flex align-items-end px-4 py-3 text-white">
    <h3>#36 HOPPER - TROPHY</h3>
</div>
</div>
</div>
<div class="row mt-5">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body p-4">
          <div class="row pt-2">
            <div class="col-12 col-md-6">
              <h4 class="text-grey">Earnings Breakdown</h4>
          </div>
          <div class="col-12 col-md-6 text-md-right pr-xl-5">
              <span class="text-grey d-flex align-items-center justify-content-end font-12">ROI <h4 class="font-weight-bold text-pink mb-0 ml-4">$20,000</h4></span>
              <span class="text-grey d-flex align-items-center justify-content-end font-12 mt-1">Direct Referral <h4 class="font-weight-bold text-violate mb-0 ml-4">$40,000</h4></span>
              <span class="text-grey d-flex align-items-center justify-content-end font-12 mt-1">Pairing <h4 class="font-weight-bold text-success mb-0 ml-4">$20,000</h4></span>
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
              <h4 class="text-grey">Commission breakdown</h4>
          </div>
          <div class="col-12 col-md-6 text-md-right">
              <select class="rounded-0 font-weight-bold border-violate font-12 p-2 px-3">
                <option value="">THIS MONTH</option>
            </select>
        </div>
        <div class="col-12 text-center mt-3">
          <img src="{{ asset('assets/images/assets/Dashboard/Group1056.png') }}" class="img-fluid" alt="logo"/>
      </div>
  </div>
  <div class="row mt-4">
    <div class="col-12 col-md-4 text-center mt-3">
      <p class="d-flex align-items-center justify-content-center mb-0 text-grey"><span class="count bg-pink d-block mr-2"></span>ROI</p>
      <h4 class="text-black font-weight-bold mt-2">$20,000</h4>
  </div>
  <div class="col-12 col-md-4 text-center mt-3">
      <p class="d-flex align-items-center justify-content-center mb-0 text-grey"><span class="count bg-violate d-block mr-2"></span>Direct referral</p>
      <h4 class="text-black font-weight-bold mt-2">$20,000</h4>
  </div>
  <div class="col-12 col-md-4 text-center mt-3">
      <p class="d-flex align-items-center justify-content-center mb-0 text-grey"><span class="count bg-success d-block mr-2"></span>Pairing</p>
      <h4 class="text-black font-weight-bold mt-2">$20,000</h4>
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
              <h4>Trending news</h4>
          </div>
          <div class="col-12 col-xl-7">
              <div class="bg-news p-4 d-flex flex-column justify-content-end">
                <h5 class="text-white">NEWS</h5>
                <h3 class="text-white">PayPal enters cryptocurrency game</h3>
                <p class="text-white font-12">PayPal is now in the cryptocurrency business. The payments platform said Wednesday that,
                thanks to a new deal, users will be able to make ..</p>
            </div>
        </div>
        <div class="col-12 col-xl-5 mt-4 mt-xl-0">
          <div class="d-flex align-items-center">
            <div>
              <img src="{{ asset('assets/images/assets/Dashboard/Group896.png') }}" class="img-fluid" alt="">
          </div>
          <div class="ml-3 border-bottom pb-3">
              <p class="font-12 mb-1">NEWS</p>
              <h5 class="font-weight-bold">These are the major companies that accept
              crypto as payment</h5>
          </div>
      </div>
      <div class="d-flex align-items-center mt-3">
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
</div>
</div>
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
              <p class="mb-4">Crypto wallet </p>
              <p class="fs-30 mb-2">$18,290.00</p>
              <p class="font-10">Balance</p>
          </div>
      </div>
  </div>
  <div class="col-12 col-md-6 col-xl-3 mt-4 mt-md-0">
      <div class="card bg-yield-wallet">
        <div class="card-body text-white">
          <p class="mb-4">Yield wallet </p>
          <p class="fs-30 mb-2">$12,880.80</p>
          <p class="font-10">Balance</p>
      </div>
  </div>
</div>
<div class="col-12 col-md-6 col-xl-3 mt-4 mt-xl-0">
  <div class="card bg-commission-wallet">
    <div class="card-body text-white">
      <p class="mb-4">Commission wallet </p>
      <p class="fs-30 mb-2">$5,373.20</p>
      <p class="font-10">Balance</p>
  </div>
</div>
</div>
<div class="col-12 col-md-6 col-xl-3 mt-4 mt-xl-0">
  <div class="card bg-NFT-wallet">
    <div class="card-body text-white">
      <p class="mb-4">NFT wallet </p>
      <p class="fs-30 mb-2">$39,630.00</p>
      <p class="font-10">Balance</p>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- content-wrapper ends -->
@endsection
