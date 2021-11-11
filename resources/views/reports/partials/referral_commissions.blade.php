<div class="row mt-4">
    <div class="col-12">
      <table class="table table-dark trading-table text-center table-responsive-sm datas">
        <thead class="table-gradient">
          <tr>
            <th>FROM USER</th>
            <th>AMOUNT</th>
            <th>STAKING POOLS</th>
            <th>DATE</th>
          </tr>
        </thead>
        <tbody>
          @if(count($referral_commission))
          @foreach($referral_commission as $key => $value)
          <tr>
            <td>{{ $value->from_user_detail->username }}</td>
            <td>{{ number_format($value->amount, 2) }}</td>
            <td>{{ (@$value->staking_pool_package->name)?$value->staking_pool_package->name:'-' }}</td>
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
        <div class="second-ajax-report">
          @if($referral_commission->count() > 0){{ $referral_commission->render() }}@endif
        </div>
      </div>
    </div>
  </div>