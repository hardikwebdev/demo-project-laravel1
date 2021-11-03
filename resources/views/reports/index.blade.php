@extends('layouts.app')
@section('title', __('custom.reports'))
@section('page_title', __('custom.reports'))
@section('content')
<div class="content-wrapper">
          <div class="row justify-content-center mt-5 pt-5">
            <div class="col-12">
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block active" data-toggle="tab" href="#home">STAKING POOLS</a></li>
                <li class="mt-3 mt-md-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu1">NODES MANAGEMENT</a></li>
                <li class="mt-3 mt-md-0"><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu2">NFT MARKETPLACE</a></li>
              </ul>
            </div>

            <div class="col-12 mt-5">
              <div class="tab-content border-0">
                <div id="home" class="tab-pane active">
                  {!! Form::open(['route' => 'reports-staking-pool-export','enctype' => 'multipart/form-data','method'=>'POST', 'id'=>'export-staking-pool'])!!}
                  <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-3 col-xl-auto pr-md-0 mt-3">
                        <p class="text-white font-weight-bold mb-0">FILTER DATE</p>
                    </div>
                    <div class="col-12 col-md-4 col-xl-auto mt-3">
                        <input name="start_date" type="text" class="form-control bg-transparent font-12 w-123" id="datepicker1" placeholder="Start Date" autocomplete="off">
                    </div>
                    <div class="col-12 col-md-1 col-xl-auto px-md-0 mt-3">
                        <p class="text-white font-weight-bold mb-0 font-12 text-center">TO</p>
                    </div>
                    <div class="col-12 col-md-4 col-xl-auto mt-3">
                        <input name="end_date" type="text" class="form-control bg-transparent font-12 w-123" id="datepicker2" placeholder="End Date" autocomplete="off">
                    </div>
                    <div class="col-12 col-md-3 col-xl-auto pr-md-0 mt-3">
                      <p class="text-white font-weight-bold mb-0">STAKING POOL</p>
                    </div>
                    <div class="col-12 col-md-3 col-xl-auto mt-3 d-flex align-items-end">
                      {!! Form::select('stackingpoolpackage',$stackingPoolPackage,old('stackingpoolpackage'),['class'=>'form-control font-12 bg-transparent w-123','placeholder'=> 'Select Stacking Pool Package' ,'id'=>'stackingpoolpackage']) !!}
                    </div>
                    <div class="col-12 col-xl-auto ml-lg-auto mt-3 text-center">
                      <button class="btn bg-warning text-white py-3 px-4 rounded-sm">EXPORT <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-3 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                  {{ Form::close() }}
                  <div class="table-responsive table-history">
                    @include('reports.partials.staking_pools_history')
                  </div>
                </div>
                <div id="menu1" class="tab-pane">
                  {!! Form::open(['route' => 'reports-pairing-commissions-export','enctype' => 'multipart/form-data','method'=>'POST', 'id'=>'reports-pairing-commissions-export'])!!}
                  <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-2 col-xl-auto pr-md-0 mt-3">
                        <p class="text-white font-weight-bold mb-0">FILTER DATE</p>
                    </div>
                    <div class="col-12 col-md-3 col-xl-auto mt-3">
                        <input name="c_start_date" type="text" class="form-control bg-transparent font-12 w-123" id="datepicker3" placeholder="Start Date" autocomplete="off">
                    </div>
                    <div class="col-12 col-md-auto col-xl-auto px-md-0 mt-3">
                        <p class="text-white font-weight-bold mb-0 font-12 text-center">TO</p>
                    </div>
                    <div class="col-12 col-md-3 col-xl-auto mt-3">
                        <input name="c_end_date" type="text" class="form-control bg-transparent font-12 w-123" id="datepicker4" placeholder="End Date" autocomplete="off">
                    </div>
                    <div class="col-12 col-md-auto col-xl-auto ml-md-auto mt-3 text-center">
                      <button class="btn bg-warning text-white py-3 px-4 rounded-sm">EXPORT <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-3 d-inline align-middle" alt=""></button>
                    </div>
                  </div>
                  {{ Form::close() }}
                  <div class="table-responsive table-history">
                    @include('reports.partials.nodes_management_history')
                  </div>
                </div>
                <div id="menu2" class="tab-pane">
                  <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-2 col-xl-auto pr-md-0 mt-3">
                        <p class="text-white font-weight-bold mb-0">FILTER DATE</p>
                    </div>
                    <div class="col-12 col-md-3 col-xl-auto mt-3">
                        <input type="text" class="form-control bg-transparent font-12 w-123" id="datepicker1" placeholder="OCT 12, 2020 ">
                    </div>
                    <div class="col-12 col-md-auto col-xl-auto px-md-0 mt-3">
                        <p class="text-white font-weight-bold mb-0 font-12 text-center">TO</p>
                    </div>
                    <div class="col-12 col-md-3 col-xl-auto mt-3">
                        <input type="text" class="form-control bg-transparent font-12 w-123" id="datepicker2" placeholder="OCT 28, 2020">
                    </div>
                    <div class="col-12 col-md-auto col-xl-auto ml-md-auto mt-3 text-center">
                      <button class="btn bg-warning text-white py-3 px-4 rounded-sm">EXPORT <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-3 d-inline align-middle" alt=""></button>
                    </div>
                  </div> 

                  <div class="row mt-4">
                    <div class="col-12">
                      <table class="table table-dark trading-table text-center table-responsive-xl">
                        <thead class="table-gradient">
                          <tr>
                            <th>NFT</th>
                            <th>NAME</th>
                            <th>AMOUNT</th>
                            <th>ORDER ID</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group553.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                            <td>BULL KONG #7097</td>
                            <td>$30,000.00</td>
                            <td>39475910</td>
                            <td>3/02/2021</td>
                            <td class="text-warning">SOLD</td>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group559.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                            <td>BULL KONG #7097</td>
                            <td>$30,000.00</td>
                            <td>39475910</td>
                            <td>3/02/2021</td>
                            <td class="text-info">PENDING</td>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group553.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                            <td>BULL KONG #7097</td>
                            <td>$30,000.00</td>
                            <td>39475910</td>
                            <td>3/02/2021</td>
                            <td class="text-warning">SOLD</td>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group559.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                            <td>BULL KONG #7097</td>
                            <td>$30,000.00</td>
                            <td>39475910</td>
                            <td>3/02/2021</td>
                            <td class="text-danger">REJECT</td>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group553.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                            <td>BULL KONG #7097</td>
                            <td>$30,000.00</td>
                            <td>39475910</td>
                            <td>3/02/2021</td>
                            <td class="text-warning">SOLD</td>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group559.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                            <td>BULL KONG #7097</td>
                            <td>$30,000.00</td>
                            <td>39475910</td>
                            <td>3/02/2021</td>
                            <td class="text-info">PENDING</td>
                            <td>
                              <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row align-items-center mt-5">
                    <div class="col-12 text-right">
                      <div class="text-secondary">
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Path599.png') }}" class="img-fluid rotate-180" alt="">
                        <span class="font-12 mx-1">1</span>
                        <span class="font-12 mx-1 bg-warning px-1">2</span>
                        <span class="font-12 mx-1">3</span>
                        <span class="font-12 mx-1">4</span>
                        <span class="font-12 mx-1">5</span>
                        <span class="font-12 mx-1">6</span>
                        <span class="font-12 mx-1">7</span>
                        <span class="font-12 mx-1">8</span>
                        <span class="font-12 mx-1">9</span>
                        <span class="font-12 mx-1">10</span>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Path599.png') }}" class="img-fluid " alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection