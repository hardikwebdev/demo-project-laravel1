@extends('layouts.app')
@section('content')
 <div class="content-wrapper">
          <div class="row mt-5 pt-5">
            <div class="col-12">
              <div class="login-gradient rounded text-white py-4 px-5">
                <h2 class="mb-0 font-weight-bold">$40,0123.95</h2>
                <p class="mb-0">Balance</p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-5">
            <div class="col-12">
              <ul class="nav nav-tabs justify-content-center account-tabs border-0">
                <li><a class="text-warning border border-warning py-3 px-5 d-block active" data-toggle="tab" href="#home">USDT</a></li>
                <li><a class="text-warning border border-warning py-3 px-5 d-block" data-toggle="tab" href="#menu1">MALAYSIA OPG</a></li>
              </ul>
            </div>

            <div class="col-12 mt-4">
              <div class="tab-content border-0">
                <div id="home" class="tab-pane active">
                  <div class="card">
                    <div class="card-body p-md-5">
                      <div class="row">
                        <div class="col-12 pb-3">
                          <h4 class="font-weight-bold">Terms & Conditions</h4>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4">
                          <ul class="text-grey">
                            <li>Withdrawal Fee is USD 10</li>
                            <li>Conversion rate of USD to USDT is 0.95</li>
                            <li>Members that have funded in USDT previousl</li>
                          </ul>
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-12 col-md-4">
                          <select class="form-control text-grey font-weight-bold h-auto py-4 border-0 outline-0 shadow">
                            <option value="">Select Fund Type</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Amount">
                        </div>
                        <div class="col-12 col-md-4 mt-4 mt-md-0">
                          <input type="text" class="form-control grey-ph h-auto py-4 border-0 shadow" placeholder="Security Password">
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white py-4 px-5 rounded-0">TOPUP FUND <img src="{{ asset('assets/images/assets/Staking_Pools/Group179.png') }}" class="img-fluid ml-4 d-inline align-middle" alt=""></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="menu1" class="tab-pane">
                </div>
              </div>  
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-12">
              <p class="text-white pb-3">NFT Wallet History</p>
            </div>
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-dark trading-table text-center">
                  <thead class="table-gradient">
                    <tr>
                      <th>DATE</th>
                      <th>AMOUNT</th>
                      <th>DESCRIPTION</th>
                      <th>STATUS</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-success">Approved</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-warning">Pending</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-success">Approved</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-success">Approved</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-danger">Reject</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-danger">Reject</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-danger">Reject</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-warning">Pending</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-warning">Pending</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-success">Approved</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                    <tr>
                      <td>12/09/2021</td>
                      <td>$1,000</td>
                      <td>Transfer To Withdrawal Wallet</td>
                      <td class="text-success">Approved</td>
                      <td>
                        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
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
          <!-- content-wrapper ends -->
@endsection