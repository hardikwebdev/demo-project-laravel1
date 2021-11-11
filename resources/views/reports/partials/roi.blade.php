<div class="row mt-4">
    <div class="col-12">
      <table class="table table-dark trading-table text-center table-responsive-sm datas">
        <thead class="table-gradient">
          <tr>
            <th>AMOUNT</th>
            {{-- <th>STAKING POOLS</th> --}}
            <th>DATE</th>
          </tr>
        </thead>
        <tbody>
          @if(count($roi))
          @foreach($roi as $key => $value)
          <tr>
            <td>{{ number_format($value->amount, 2) }}</td>
            {{-- <td>{{ (@$value->stacking_pool->name)?$value->stacking_pool->name:'-' }}</td> --}}
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
          @if($roi->count() > 0){{ $roi->render() }}@endif
        </div>
      </div>
    </div>
  </div>