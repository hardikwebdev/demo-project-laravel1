<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{config('app.name', 'Defix Finance ')}} | @yield('title','Home')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/index.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/slick.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/slick-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/jquery-ui.css') }}">
  <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.header')
    <div class="container-fluid page-body-wrapper">
     @include('layouts.sidebar')

     <div class="main-panel">
        @yield('content')
        <!-- main-panel ends -->
        @include('layouts.footer')
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>   
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
@include('layouts.jstrans')
<script src="{{ asset('assets/js/custom/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/custom/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/jquery-ui.js') }}"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
<script src="{{ asset('assets/js/custom/custom.js').'?v='.time() }}"></script>
<script src="{{asset('backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{asset('backend/js/plugins/validate/additional-methods.min.js')}}"></script>
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
@yield('scripts')
</body>

</html>