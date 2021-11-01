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
  <link rel="stylesheet" href="{{ asset('backend/css/dropify.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/index.css').'?v='.time() }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/slick.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/slick-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/jquery.steps.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/sweetalert.css')}}">
  <link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">
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
<script src="{{ asset('assets/js/custom/jquery.steps.min.js') }}"></script>
<script src="{{asset('backend/js/dropify.min.js')}}"></script>
<script type="text/javascript" src="https://keith-wood.name/js/jquery.signature.js"></script>
<script src="{{asset('backend/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{asset('backend/js/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets/js/custom/custom.js').'?v='.time() }}"></script>
<script src="{{asset('backend/js/plugins/validate/additional-methods.min.js')}}"></script>
<script>
 var sponsorUsernameExits = "{{route('sponsorUsernameExits')}}";
 var placementUsernameExits = "{{route('placementUsernameExits')}}";

 var emailExists = "{{route('emailExists')}}";
 var usernameExits = "{{route('usernameExits')}}";
</script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  });
</script>
@if($planExpired)
@foreach($expired_stacking_pools as $stacking_pool)
<script type="text/javascript">
    $('#planExpired{{$stacking_pool->id}}').modal('show');
    
</script>
@endforeach
@endif
@yield('scripts')
</body>

</html>