<table class="table table-dark trading-table text-center table-responsive-sm table-pisprebate">
    <thead class="table-gradient">
        <tr>
            <th>{{trans('custom.amount')}}</th>
            <th>{{trans('custom.withdrawal_fee')}}</th>
            <th>{{trans('custom.type')}}</th>
            <th>{{trans('custom.date')}}</th>
            <th>{{trans('custom.status')}}</th>
            <th>{{trans('custom.remarks')}}</th>
        </tr>
    </thead>
    <tbody>
        @if(count($withdrawWallet))
        @foreach($withdrawWallet as $key => $value)  
        <tr>
            <td>${{ number_format($value->withdrawal_amount, 2)}}</td>
            <td>${{ $value->withdrawal_amount-$value->payble_amount }}</td>
            <td>
                @if($value->type == 0)
                {{trans('custom.bank')}}                    
                @elseif($value->type == 1)
                {{trans('custom.USDT')}}
                @endif
            </td>
            <td>{{date("d/m/Y",strtotime($value->created_at))}}</td>
            @if($value->status == 0)
            <td class="text-warning">{{trans('custom.pending')}}</td>
            @elseif($value->status == 1)
            <td class="text-success">{{trans('custom.approved')}}</td>
            @elseif($value->status == 2)
            <td class="text-danger">{{trans('custom.rejected')}}</td>
            @else
            <td class="text-danger">{{trans('custom.verifying')}}</td>
            @endif
            @if($value->status == 2)
            <td>
                {{$value->remarks}}
            </td>
            @else
            <td>-</td>
            @endif
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="10" class="no-records text-center">{{trans('custom.no_data_found')}}</td>
        </tr>
        @endif
    </tbody>
</table>