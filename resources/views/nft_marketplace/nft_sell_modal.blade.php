<div class="modal fade" id="bullKongModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content border-0 bg-transparent">
                <div class="modal-body">
                  <div class="row align-items-center">
                    <div class="col-12 col-lg-6">
                      <img src="{{ asset('uploads/nft-product/'.$product->image) }}" class="img-fluid rounded-top" alt="">
                    </div>
                    <div class="col-12 col-lg-6 text-white mt-4 mt-lg-0">
                      <h2>{{ $product->name }} #{{ $product->id}}</h2>
                      <p class="font-12 w-75 mt-3 cus-lighn-height">{{ $product->description}}</p>
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