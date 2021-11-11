<table class="table table-dark trading-table text-center">
	<thead class="table-gradient">
		<tr>
			<th>AMOUNT</th>
			<th>DATE</th>
		</tr>
	</thead>
	<tbody>
		@if(count($purchaseHistory) > 0)
		@foreach($purchaseHistory as $value)
		<tr>
			<td>${{ number_format($value->amount, 2) }}</td>
			<td>{{ date("d/m/Y",strtotime($value->created_at)) }}</td>
		</tr>
		@endforeach
		@else
		<tr>
		    <td colspan="10" class="no-records text-center">{{trans('custom.no_data_found')}}</td>
		</tr>
		@endif
		{{-- <tr>
			<td>$20,000</td>
			<td>12/09/2021</td>
		</tr>
		<tr>
			<td>$20,000</td>
			<td>12/09/2021</td>
		</tr>
		<tr>
			<td>$20,000</td>
			<td>12/09/2021</td>
		</tr>
		<tr>
			<td>$20,000</td>
			<td>12/09/2021</td>
		</tr>
		<tr>
			<td>$20,000</td>
			<td>12/09/2021</td>
		</tr> --}}
	</tbody>
</table>
<div class="col-12 text-right">
	<div class="text-secondary">
		<div class="second-ajax-pag ">
			@if($purchaseHistory->count() > 0){{ $purchaseHistory->render() }}@endif   
		</div>
	</div>
</div>
