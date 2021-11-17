<div class="modal fade" id="view-breakdown" tabindex="-1" role="dialog" aria-labelledby="newticketsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title inline text-white" id="exampleModalLabel">
                    {{trans('custom.amount-breakdown')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive model-table-history">
                    <table class="table table-dark trading-table text-center table-responsive-sm datas">
                        <thead class="table-gradient">
                          <tr>
                            <th>{{trans('custom.AMOUNT')}}
                            </th>
                            <th>{{trans('custom.PERCENTAGE')}}</th>
                            <th>{{trans('custom.FROM_USER')}}</th>
                            <th>{{trans('custom.DATE')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($stackingpool))
                          @foreach($stackingpool as $key => $value)
                          <tr>
                            <td>{{ $value->amount }}</td>
                            <td>{{ $value->percent }}</td>
                            <td>{{ $value->from_user_detail->username }}</td>
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
                <div class="row align-items-center mt-5">
                  <div class="col-12 text-right">
                    <div class="text-secondary">
                      <div class="model-second-ajax-report">
                        @if($stackingpool->count() > 0){{ $stackingpool->render() }}@endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
