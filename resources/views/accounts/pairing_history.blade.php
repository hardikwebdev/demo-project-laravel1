<div class="row mt-5">
  <div class="col-12">
    <div class="table-responsive">
      <table class="table table-dark trading-table text-center">
        <thead class="table-gradient">
          <tr>
            <th>#</th>
            <th class="text-uppercase">{{ __('custom.sale_left') }}</th>
            <th class="text-uppercase">{{ __('custom.sale_right') }}</th>
            <th class="text-uppercase">{{ __('custom.net_pairing_left') }}</th>
            <th class="text-uppercase">{{ __('custom.net_pairing_right') }}</th>
            <th class="text-uppercase">%</th>
            <th class="text-uppercase">{{ __('custom.daily_max_commission') }}</th>
            <th class="text-uppercase">{{ __('custom.commission_earned') }}</th>
            <th class="text-uppercase">{{ __('custom.date') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pairingHistory as $commission)
          <tr>
            <td>{{$commission->id}}</td>
            <td>${{$commission->left_sale}}</td>
            <td>${{$commission->right_sale}}</td>
            <td>${{($commission->commission_got_from == 'left') ? $commission->actual_amount : 0 }}</td>
            <td>${{($commission->commission_got_from == 'right') ? $commission->actual_amount : 0 }}</td>
            <td>{{$commission->pairing_percent}}%</td>
            <td>${{$commission->daily_limit}}</td>
            <td>${{$commission->pairing_commission}}</td>
            <td>{{$commission->created_at}}</td>
          </tr>
          @endforeach
            <!-- <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr>
            <tr>
              <td>1</td>
              <td>$0</td>
              <td>$0</td>
              <td>$0.00</td>
              <td>$0.00</td>
              <td>$7.00</td>
              <td>5000.00</td>
              <td>$7.00</td>
              <td>12/09/2021</td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row align-items-center mt-5">
    <div class="col-12 text-right">
      <div class="text-secondary">
        <div class="second-ajax-pag ">
          @if($pairingHistory->count() > 0){{ $pairingHistory->render() }}@endif   
        </div>
      </div>
    </div>
    