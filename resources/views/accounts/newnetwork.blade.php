@extends('layouts.app')
@section('title', __('custom.node_management'))
@section('page_title', __('custom.node_management'))
@section('css')

@endsection
@section('content')
<div class="content-wrapper nodes">
  <div class="ml-2 mb-4 d-none-desk d-md-block">
    <h2 class="text-warning font-weight-bold">@yield('page_title','Dashboard')</h2>
    @if(Route::currentRouteName() == 'dashboard')
    <p class="text-white">{{str_replace('#name',auth()->user()->name,__('custom.wc_text'))}}</p>
    @endif
  </div>
  <div class="row mt-3">
    <div class="col-12 col-xl-8">
      <!-- <img src="{{ asset('assets/images/assets/Node_Management/Group1055.png') }}" class="img-fluid w-100" alt="" style="height: 460px;"> -->
      <div class="chart" id="collapsable-example" style="background-color:#ffffff;"></div>
    </div>
    <div class="col-12 col-xl-4 mt-4 mt-xl-0">
      <div class="table-responsive">
        <table class="table table-dark trading-table text-center">
          <thead class="table-gradient">
            <tr>
              <th class="text-uppercase" width="50%">{{__('custom.left')}}</th>
              <th class="text-uppercase" width="50%">{{__('custom.right')}}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-left text-uppercase">{{__('custom.accumulate_grp_sale')}}</td>
              <td></td>
            </tr>
            <tr>
              <td> ${{$accumulateLeftSale}}</td>
              <td> ${{$accumulateRightSale}}</td>
            </tr>
            <tr>
              <td class="text-left text-uppercase">{{__('custom.today_grp_sale')}}</td>
              <td></td>
            </tr>
            <tr>
              <td> ${{$todaysLeftSale}}</td>
              <td> ${{$todaysRightSale}}</td>
            </tr>
            <tr>
              <td class="text-left text-uppercase">{{ __('custom.carry_forward') }}</td>
              <td></td>
            </tr>
            <tr>
              <td> ${{$todaysLeftCarryFw}}</td>
              <td> ${{$todaysRightCarryFw}}</td>
            </tr>
            <tr>
              <td class="text-left text-uppercase">{{ __('custom.daily_max_commission') }}</td>
              <td></td>
            </tr>
            <tr>
              <td> ${{$dailyMaxCommission}}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>  
  </div>
  <div class="row mt-5">
    <div class="col-12 col-xl-3 pr-0">
      <div class="bg-warning text-white p-5 rounded-left">
        <div class="ml-xl-4">
          <h4 class="font-weight-bold">${{$accumulateLeftSale}}</h4>
          <span> {{ __('custom.sale_left') }}</span>
        </div>
        <div class="mt-5 ml-xl-4">
          <h4 class="font-weight-bold">${{$accumulateRightSale}}</h4>
          <span> {{ __('custom.sale_right') }}</span>
        </div>
        <div class="mt-5 ml-xl-4">
          <h4 class="font-weight-bold">${{$totalCommission}}</h4>
          <span> {{ __('custom.commission') }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-xl-9 pl-0">
      <div class="" id="hightlinechart" class="img-fluid rounded-right w-100" alt="" style="height: 336px;"></div>
<!--       <img src="{{ asset('assets/images/assets/Node_Management/Group1054.png') }}" class="img-fluid rounded-right w-100" alt="" style="height: 336px;">
-->    </div>  
</div>

<div class="table-history">

  @include('accounts.pairing_history')
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  var users = {!! json_encode($users[0]) !!};
  console.log(users);
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="{{ asset('assets/treanttree/js/raphael.js') }}"></script>
<script src="{{ asset('assets/treanttree/js/Treant.js') }}"></script>
<script src="{{ asset('assets/treanttree/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/treanttree/js/jquery.easing.js') }}"></script>
<script src="{{ asset('assets/treanttree/js/collapsable.js').'?v='.time() }}"></script>
<script type="text/javascript">
  jQuery(function($){
    tree = new Treant( chart_config );
  });

  $(document).ready(function(e){
    // var users = {!! json_encode($users) !!};
    // init(users,1);
  });
  Highcharts.chart('hightlinechart', {
    exporting:false,
    title: {
      text: "{{ __('custom.commissionsale') }}"
    },
    yAxis: {
      title: {
        text: ''
      }
    },
    xAxis: {
      accessibility: {
        rangeDescription: ''
      },
      categories: {!! json_encode(array_values($months)) !!}
    },

    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },

    plotOptions: {
      series: {
        label: {
          connectorAllowed: false
        },
      }
    },

    series: [{
      name: "{{ __('custom.sale_left') }}",
      data: {!! json_encode($graph['sale_left']) !!}
    }, {
      name: "{{ __('custom.sale_right') }}",
      data: {!! json_encode($graph['sale_right']) !!}
    }, {
      name: "{{ __('custom.commission') }}",
      data: {!! json_encode($graph['pairing_commission']) !!}
    }],

    responsive: {
      rules: [{
        condition: {
          maxWidth: 500
        },
        chartOptions: {
          legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
          }
        }
      }]
    }

  });
</script>
@endsection
