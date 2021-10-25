<table class="table table-dark trading-table text-center table-responsive-sm">
  <thead class="table-gradient">
    <tr>
      <th>DATE</th>
      <th>AMOUNT</th>
      <th>TYPE</th>
      <th>PAYMENT PROOF</th>
      <th>DESCRIPTION</th>
      <th>STATUS</th>
      {{-- <th>&nbsp;</th> --}}
    </tr>
  </thead>
  <tbody>
    @if(count($cryptowallet))
    @foreach($cryptowallet as $key => $value)
    <tr>
      <td>{{date("d/m/Y",strtotime($value->created_at))}}</td>
      <td>${{ number_format($value->amount, 2)}}</td>
      @if($value->type == 0)
      <td>USDT</td>
      @else
      <td>-</td>
      @endif
      @if($value->trans_slip)
      <td><a target="_blank" href="{{asset('uploads/upload_bank_proof/'.$value->trans_slip)}}">View</a></td>
      @else
      <td>-</td>
      @endif
      <td>{{ ($value->remark)? $value->remark:'-'}}</td>
      @if($value->status == 0)
      <td class="text-warning">Pending</td>
      @endif
      @if($value->status == 1)
      <td class="text-success">Approved</td>
      @endif
      @if($value->status == 2)
      <td class="text-danger">Reject</td>
      @endif
    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="10" class="no-records text-center">{{trans('custom.no_data_found')}}</td>
    </tr>
    @endif
    {{-- <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-warning">Pending</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-success">Approved</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-success">Approved</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-danger">Reject</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-danger">Reject</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-danger">Reject</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-warning">Pending</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-warning">Pending</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-success">Approved</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr>
    <tr>
      <td>12/09/2021</td>
      <td>$1,000</td>
      <td>Transfer To Withdrawal Wallet</td>
      <td class="text-success">Approved</td>
      <td>
        <img src="{{ asset('assets/images/assets/Sell_NFT/Group554.png') }}" class="img-fluid rounded-0 w-auto h-auto" alt="">
      </td>
    </tr> --}}
  </tbody>
</table>