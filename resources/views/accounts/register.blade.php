@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="row w-100 mx-0 mt-5 pt-5">
    <div class="col-12 mx-auto">
      <div class="row align-items-center login-gradient rounded py-4 p-md-5">
        <div class="col-12 text-center">
          <img src="images/assets/Register_Account/Group83.png" class="img-fluid" alt="logo">
        </div>
        <div class="col-12 mt-5 text-white">
          <h2 class="font-weight-bold">Register Account</h2>
          <h5 class="text-light-pink">Enter the following to create your account</h5>
        </div>

        <div class="col-12">
          <form method="" action="login.html" class="customer-register py-5" id="form-wizards-register">
            <h1>PERSONAL & ACCOUNT DETAILS</h1>
            <fieldset>
              <div class="row justify-content-center mt-5">
                <div class="col-12 col-xl-6">
                  <div class="row">
                    <div class="col-12">
                      <h4 class="text-white">Verify Sponsor Name</h4>
                    </div>
                    <div class="col-12 col-lg-7 pr-lg-0">
                      <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Sponsor Name">
                    </div>
                    <div class="col-12 col-lg-5 mt-2 mt-lg-0">
                      <button class="btn bg-warning text-white py-4 font-weight-bold rounded-0 font-18">VERIFY <img src="../images/assets/Staking_Pools/Group179.png" class="img-fluid ml-3 align-middle" alt=""></button>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-xl-6 mt-5 mt-xl-0">
                  <div class="row">
                    <div class="col-12">
                      <h4 class="text-white">Verify User Name</h4>
                    </div>
                    <div class="col-12 col-lg-7 pr-lg-0">
                      <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="User Name">
                    </div>
                    <div class="col-12 col-lg-5 mt-3 mt-lg-0">
                      <button class="btn bg-warning text-white py-4 font-weight-bold rounded-0 font-18">VERIFY <img src="../images/assets/Staking_Pools/Group179.png" class="img-fluid ml-3 align-middle" alt=""></button>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-center mt-4">
                  <label class="cus-radio">
                    <input class="d-none" type="radio" name="cusradio" checked>
                    <span>LEFT</span>
                  </label>
                  <label class="cus-radio">
                    <input class="d-none" type="radio" name="cusradio">
                    <span>RIGHT</span>
                  </label>
                </div>

                <div class="col-12">
                  <hr class="border border-white mt-4">
                </div>
                <div class="col-12 mt-4">
                  <h4 class="text-white">Personal & Account Detail</h4>
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Full Name">
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pr-md-0 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Username">
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Idendification ID">
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Phone No">
                </div>
                <div class="col-12 col-md-8 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Address">
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="State">
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pr-md-0 pl-md-2">
                  <select class="form-control text-grey font-weight-bold h-auto py-4 rounded-0">
                    <option value="">Select a Country</option>
                  </select>
                </div>
                <div class="col-12 col-md-4 mt-2 pt-1 pl-md-2">
                  <select class="form-control text-grey font-weight-bold h-auto py-4 rounded-0">
                    <option value="">City</option>
                  </select>
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Email">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Repeat Email">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Login Password">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Repeat Password">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Security Password">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Repeat Security Password">
                </div>
              </div>              
            </fieldset>
            <h1>BANK DETAILS</h1>
            <fieldset>
              <div class="row justify-content-center mt-5">       
                <div class="col-12">
                  <h4 class="text-white">Bank Detail</h4>
                </div>               
                <div class="col-12 col-md-6 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Name of Bank">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Name of Account Holder">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Bank Branch">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pl-md-2">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Swift Code">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pr-md-0">
                  <input type="text" class="form-control grey-ph h-auto py-4 rounded-0" placeholder="Account Number">
                </div>
                <div class="col-12 col-md-6 mt-2 pt-1 pl-md-2">
                  <select class="form-control text-grey font-weight-bold h-auto py-4 rounded-0">
                    <option value="">Select a Country</option>
                  </select>
                </div>
              </div>
            </fieldset>
            <h1>USER AGREEMENT</h1>
            <fieldset>
              <div class="row justify-content-center mt-5">
                <div class="col-12">
                  <h4 class="text-white">Verify Sponsor Name</h4>
                </div>
                <div class="col-12">
                  <hr class="border border-white">
                </div>
                <div class="col-12 text-white">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet,
                  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p class="mt-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet,
                  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 col-md-6">
                <div class="card rounded-0">
                  <div class="card-body">
                    <label class="" for="">Draw Signature:</label>
                    <br/>
                    <div id="sigpad"></div>
                    <br><br>
                    <button id="clear" class="btn btn-danger rounded-0">Clear Signature</button>
                    <textarea id="signature" name="signed" style="display: none"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
        </form> 
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
 $(document).ready(function(){  
  $("#form-wizards-register").steps({
    bodyTag: "fieldset",
    labels:{
      finish: '<button class="btn bg-warning text-white py-4 px-5 font-weight-bold rounded-0 mt-4 mt-md-2 font-18" id="finish">FINISH</button>',
      next: '<button class="btn bg-warning text-white py-4 px-5 font-weight-bold rounded-0 mt-4 mt-md-2 font-18">NEXT <img src="../images/assets/Staking_Pools/Group179.png" class="img-fluid ml-3 align-middle" alt=""></button>',
      previous: '<button class="btn bg-transparent border-warning text-white py-4 px-5 mt-4 mt-md-2 font-weight-bold rounded-0 font-18">PREVIOUS <img src="../images/assets/Staking_Pools/Group179.png" class="img-fluid ml-3 align-middle" alt=""></button>'
    },

    onInit: function (event, current) {
      var sigpad = $('#sigpad').signature({syncField: '#signature', syncFormat: 'PNG'});
      $('#clear').click(function(e) {
        e.preventDefault();
        sigpad.signature('clear');
        $("#signature").val('');
      });
      $('.actions > ul > li:first-child').attr('style', 'display:none');
    },
    onStepChanging: function (event, currentIndex, newIndex){    
      $('.actions > ul > li:first-child').attr('style', 'display:block');
      return true;
    }
    
  });   
  $('#finish').click(function() {
      // window.location.href = 'login.html';
      return false;
    });
});   

</script>
@endsection
