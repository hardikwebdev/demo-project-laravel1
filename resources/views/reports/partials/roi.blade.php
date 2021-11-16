<div class="row mt-4">
  <div class="col-12">
    <table class="table table-dark trading-table text-center table-responsive-sm datas">
      <thead class="table-gradient">
        <tr>
          <th>YIELD AMOUNT</th>
          <th>YIELD WALLET</th>
          <th>NFT WALLET</th>
          <th>YIELD</th>
          <th>STACKING AMOUNT</th>
          <th>STACKING POOLS</th>
          <th>STACKING DATE</th>
          <th>DURATION</th>
          <th>DATE</th>
        </tr>
      </thead>
      <tbody>
        @if(count($roi))
        @foreach($roi as $key => $value)
        <tr>
          <td>${{ number_format($value->actual_commission_amount, 2) }}</td>
          <td>${{ number_format($value->amount, 2) }}</td>
          <td>${{ number_format($value->actual_commission_amount-$value->amount, 2) }}</td>
          <td>{{ (@$value->percent)?$value->percent:0 }}</td>
          <td>{{ (@$value->stacking_pool->amount)?$value->stacking_pool->amount:0 }}</td>
          <td>{{ (@$value->stacking_pool->staking_pool_package)?$value->stacking_pool->staking_pool_package->name:0 }}</td>
          <td>{{ date("d/m/Y",strtotime($value->stacking_pool->created_at)) }}</td>
          <td>{{ date("d/m/Y",strtotime($value->stacking_pool->duration)) }}{{__('custom.months')}}</td>

          <td>{{ date("d/m/Y",strtotime($value->created_at)) }}</td>
        </tr>
        @endforeach
        @else
        <tr >
          <td colspan="10" class="no-records text-center">{{trans('custom.no_data_found')}}</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
<div class="row align-items-center mt-5">
  <div class="col-12 text-right">
    <div class="text-secondary">
      <div class="roi-second-ajax-report">
        @if($roi->count() > 0){{ $roi->render() }}@endif
      </div>
    </div>
  </div>
</div>