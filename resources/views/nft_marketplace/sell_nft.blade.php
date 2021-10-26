@extends('layouts.app')

@section('content')
  <div class="content-wrapper">
          <div class="row mt-5 pt-5">
            <div class="col-12 col-md-6 col-xl-3">
              <div class="bg-white p-3 rounded mx-2" data-toggle="modal" data-target="#bullKongModal">
                <div class="position-relative overflow-hidden">
                  <img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1044.png') }}" class="img-fluid w-100" alt="">
                  <span class="sale-label">ON SALE</span>
                </div>
                <div class="mt-3">
                  <h4 class="text-blue font-weight-bold">BULL KONG #7097</h4>
                  <h3 class="text-black font-weight-bold">$20,000</h3>
                  <span class="text-secondary">03/8/2021</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 mt-4 mt-md-0">
              <div class="bg-white p-3 rounded mx-2" data-toggle="modal" data-target="#bullKongModal">
                <img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1045.png') }}" class="img-fluid w-100" alt="">
                <div class="mt-3">
                  <h4 class="text-blue font-weight-bold">KONG #7097</h4>
                  <h3 class="text-black font-weight-bold">$20,000</h3>
                  <span class="text-secondary">03/8/2021</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 mt-4 mt-xl-0">
              <div class="bg-white p-3 rounded mx-2" data-toggle="modal" data-target="#bullKongModal">
                <div class="position-relative overflow-hidden">
                  <img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1046.png') }}" class="img-fluid w-100" alt="">
                  <span class="sale-label">ON SALE</span>
                </div>
                <div class="mt-3">
                  <h4 class="text-blue font-weight-bold">KONG BOSS#7097</h4>
                  <h3 class="text-black font-weight-bold">$20,000</h3>
                  <span class="text-secondary">03/8/2021</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3 mt-4 mt-xl-0">
              <div class="bg-white p-3 rounded mx-2" data-toggle="modal" data-target="#bullKongModal">
                <img src="{{ asset('assets/images/assets/NFT_Marketplace/Group1047.png') }}" class="img-fluid w-100" alt="">
                <div class="mt-3">
                  <h4 class="text-blue font-weight-bold">BULL KONG #7097</h4>
                  <h3 class="text-black font-weight-bold">$20,000</h3>
                  <span class="text-secondary">03/8/2021</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-12">
              <div>
                <p class="text-white pb-3">Sale History</p>
              </div>
              <table class="table table-dark trading-table text-center table-responsive-sm">
                <thead class="table-gradient">
                  <tr>
                    <th>NFT</th>
                    <th>NAME</th>
                    <th>AMOUNT</th>
                    <th>ORDER ID</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th></th>
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
                  <tr>
                    <td>
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group553.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
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
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group559.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
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
        <!----------------------------------------------- modal------------------------------------------------->

          <div class="modal fade" id="bullKongModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content border-0 bg-transparent">
                <div class="modal-body">
                  <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                      <img src="{{ asset('assets/images/assets/Sell_NFT/Group506.png') }}" class="img-fluid rounded-top" alt="">
                    </div>
                    <div class="col-12 col-lg-6 text-white mt-4 mt-lg-0">
                      <h2>BULL KONG #7097</h2>
                      <p class="font-12 w-75 mt-3 cus-lighn-height">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id mi imperdiet,
                        tempus est ut, efficitur enim. Vivamus mattis ante non risus sollicitudin
                        consectetur. Quisque dapibus tortor non lectus luctus, volutpat faucibus nulla
                        ullamcorper</p>
                      <div class="row justfy-content-between align-items-center mt-4">
                        <div class="col-12 col-xl-6 pr-xl-0">
                          <input type="text" class="py-3 form-control grey-ph h-auto py-4" placeholder="Amount">
                        </div>
                        <div class="col-12 col-xl-6 mt-4 mt-xl-0">
                          <input type="text" class="py-3 form-control grey-ph h-auto py-4" placeholder="Security Password">
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                          <button class="btn bg-warning text-white p-4 px-5 rounded-0">SELL NOW</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection