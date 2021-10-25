@extends('layouts.app')

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
                </div>
                <div class="row px-4 mt-4">
                  <div class="col-md-6">
                      <h4 class="text-dark font-weight-bold mb-0">Andy John</h4>
                      <span class="text-secondary font-12">Full name</span>
                  </div>
                  <div class="col-md-6">
                    <h4 class="text-dark font-weight-bold mb-0">Gold</h4>
                    <span class="text-secondary font-12" >Rank</span>
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
            <div class="col-12 col-xl-8 mt-4 mt-xl-0">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body pb-xl-1 pt-xl-2">
                      <div class="row align-items-center">
                        <div class="col-12 col-xl-4">
                          <div class="row align-iems-center justify-content-between">
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">28928475</h4>
                              <span class="text-secondary font-10">Defix Finance ID</span>
                            </div>
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">******5749</h4>
                              <span class="text-secondary font-10">Phone number</span>
                            </div>
                          </div>
                          <div class="row align-iems-center justify-content-between mt-4">
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">4/8/2020</h4>
                              <span class="text-secondary font-10">Date Joined</span>
                            </div>
                            <div class="col-12 col-md-6">
                              <h4 class="text-black mb-0 font-weight-bold">6</h4>
                              <span class="text-secondary font-10">Total Staking Packag</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-xl-8">
                          <div class="collection-slider">
                            <div>
                              <div class="bg-card-1 text-center p-4 rounded mx-2">
                                <img src="{{ asset('assets/images/assets/My_Collection/Group610.png') }}" class="img-fluid w-60 mx-auto card-img-top" alt="">
                                <h5 class="text-white mt-3">ALPHA</h5>
                                <p class="text-white font-10">The Cosmos Hub keeps track of balances and
                                  routes transactions through the internet of
                                  blockchains.</p>
                                  <hr class="border-white my-1"/>
                                <p class="text-white font-10">Expected Annual Reward Rate</p>
                                <h4 class="text-white font-weight-bold">5% - 10%</h4>
                                <div class="d-flex align-items-center justify-content-center mt-3">
                                  <span class="font-10 font-weight-bold mr-2 mb-0">Invested <br/> Amounts</span>
                                  <button class="btn bg-blue text-white rounded-0 px-4 font-12 py-2">$20,000</button>
                                </div>
                              </div>
                            </div>
                            <div>
                              <div class="bg-card-2 text-center p-4 rounded mx-2">
                                <img src="{{ asset('assets/images/assets/My_Collection/Group610.png') }}" class="img-fluid w-60 mx-auto card-img-top" alt="">
                                <h5 class="text-white mt-3">ALPHA</h5>
                                <p class="text-white font-10">The Cosmos Hub keeps track of balances and
                                  routes transactions through the internet of
                                  blockchains.</p>
                                  <hr class="border-white my-1"/>
                                <p class="text-white font-10">Expected Annual Reward Rate</p>
                                <h4 class="text-white font-weight-bold">5% - 10%</h4>
                                <div class="d-flex align-items-center justify-content-center mt-3">
                                  <span class="font-10 font-weight-bold mr-2 mb-0">Invested <br/> Amounts</span>
                                  <button class="btn bg-blue text-white rounded-0 px-4 font-12 py-2">$20,000</button>
                                </div>
                              </div>
                            </div>
                            <div>
                              <div class="bg-card-3 text-center p-4 rounded mx-2">
                                <img src="{{ asset('assets/images/assets/My_Collection/Group610.png') }}" class="img-fluid w-60 mx-auto card-img-top" alt="">
                                <h5 class="text-white mt-3">ALPHA</h5>
                                <p class="text-white font-10">The Cosmos Hub keeps track of balances and
                                  routes transactions through the internet of
                                  blockchains.</p>
                                  <hr class="border-white my-1"/>
                                <p class="text-white font-10">Expected Annual Reward Rate</p>
                                <h4 class="text-white font-weight-bold">5% - 10%</h4>
                                <div class="d-flex align-items-center justify-content-center mt-3">
                                  <span class="font-10 font-weight-bold mr-2 mb-0">Invested <br/> Amounts</span>
                                  <button class="btn bg-blue text-white rounded-0 px-4 font-12 py-2">$20,000</button>
                                </div>
                              </div>
                            </div>
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
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block active" data-toggle="tab" href="#home">PERSONAL DETAILS</a></li>
                <li class="mt-3 mt-md-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu1">ACCOUNT DETAILS </a></li>
                <li class="mt-3 mt-md-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu2">BANK DETAILS</a></li>
                <li class="mt-3 mt-xl-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu3">USER AGREEMENT</a></li>
              </ul>
            </div>

            <div class="col-12 mt-4">
              <div class="tab-content border-0">
                <div id="home" class="tab-pane active">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="Andy">
                    </div>
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="John">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="andy@outlook.com">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="012-345 6789">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="1442 Loving Acres Road, Kansas City, Missouri">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="64105">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="United State">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Kansas City">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Missouri">
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE PROFILE <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                </div>
                <div id="menu1" class="tab-pane">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="Andy">
                    </div>
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="John">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="andy@outlook.com">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="012-345 6789">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="1442 Loving Acres Road, Kansas City, Missouri">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="64105">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="United State">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Kansas City">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Missouri">
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE ACCOUNT <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                </div>
                <div id="menu2" class="tab-pane">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="Andy">
                    </div>
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="John">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="andy@outlook.com">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="012-345 6789">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="1442 Loving Acres Road, Kansas City, Missouri">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="64105">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="United State">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Kansas City">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Missouri">
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE BANK <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                </div>
                <div id="menu3" class="tab-pane">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="Andy">
                    </div>
                    <div class="col-12 col-md-6 mt-4 mt-md-0">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="John">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="andy@outlook.com">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="012-345 6789">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="1442 Loving Acres Road, Kansas City, Missouri">
                    </div>
                    <div class="col-12 col-md-6 mt-4">
                      <input type="text" class="form-control blue-ph h-auto py-4" placeholder="64105">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="United State">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Kansas City">
                    </div>
                    <div class="col-12 col-md-4 mt-4">
                      <input type="text" class="form-control h-auto py-4" placeholder="Missouri">
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mt-4">
                      <button class="btn bg-warning text-white py-4 px-5 rounded-0">UPDATE USER <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection