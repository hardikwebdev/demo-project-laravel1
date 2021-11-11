<div class="row mt-4">
  <div class="col-12">
    <table class="table table-dark trading-table text-center table-responsive-xl">
      <thead class="table-gradient">
        <tr>
          <th>SALES LEFT</th>
          <th>SALES RIGHT</th>
          <th>CARRY FORWARD LEFT</th>
          <th>CARRY FORWARD RIGHT</th>
          <th>DAILY LIMIT</th>
          <th>PERCENTAGE</th>
          <th>DATE</th>
        </tr>
      </thead>
      <tbody>
        @if(count($paring_commissions))
        @foreach($paring_commissions as $key => $value)
        <tr>
          <td>{{ $value->left_sale }}</td>
          <td>{{ $value->right_sale }}</td>
          <td>
            @if($value->commission_got_from == 'right')
              {{ $value->carry_forward }}
            @else
            -
            @endif
          </td>
          <td>
            @if($value->commission_got_from == 'left')
              {{ $value->carry_forward }}
            @else
            -
            @endif
          </td>
          <td>{{ $value->daily_limit}}</td>
          <td>{{ $value->pairing_percent}}%</td>
          <td>{{ date("d/m/Y",strtotime($value->created_at)) }}</td>
        </tr>
        @endforeach
        @else
        <tr>
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
      <div class="nodes-management-second-ajax-report">
        @if($paring_commissions->count() > 0){{ $paring_commissions->render() }}@endif
      </div>
    </div>
  </div>
</div>