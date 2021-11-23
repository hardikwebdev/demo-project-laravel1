<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{config('app.name', 'DefiXFinance ')}} | @yield('title','Home')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customd.css') }}">
  <link rel="icon" href="https://defixfinance.com/wp-content/uploads/2021/09/cropped-defix-favicon-32x32.png" sizes="32x32" />
<link rel="icon" href="https://defixfinance.com/wp-content/uploads/2021/09/cropped-defix-favicon-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="https://defixfinance.com/wp-content/uploads/2021/09/cropped-defix-favicon-180x180.png" />
<meta name="msapplication-TileImage" content="https://defixfinance.com/wp-content/uploads/2021/09/cropped-defix-favicon-270x270.png" />
  <link rel="stylesheet" href="{{ asset('assets/css/custom/index.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/jquery.steps.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/jquery-ui.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
  <style>
  .kbw-signature { width: 100%; height: 200px;}
  #sigpad canvas{ width: 100% !important; height: 198px;}
      
</style>  
    <style type="text/css">
    					 @font-face {font-family: "EUROSTIB";font-display: auto;font-fallback: ;font-weight: 100;src: url(https://app.defixfinance.com/public/assets/fonts/EUROSTIB.ttf) format('TrueType');}				</style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center bg-login-img">
        @yield('content')
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('layouts.jstrans')
  <script src="{{ asset('assets/js/custom/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/custom/custom.js').'?v='.time() }}"></script>
  <script src="{{ asset('assets/js/custom/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom/slick.min.js') }}"></script>
  <script src="{{asset('backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
  <script src="{{asset('backend/js/plugins/validate/additional-methods.min.js')}}"></script>
  <script>
   var sponsorUsernameExits = "{{route('sponsorUsernameExits')}}";
   var placementUsernameExits = "{{route('placementUsernameExits')}}";

   var emailExists = "{{route('emailExists')}}";
   var usernameExits = "{{route('usernameExits')}}";
    $('.alert-success').fadeIn().delay(4000).fadeOut();
    $('.alert-danger').fadeIn().delay(4000).fadeOut();
 </script>
 <script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });
</script>
@yield('scripts')

</body>

</html>
