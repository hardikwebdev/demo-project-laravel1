<div class="modal fade" id="view-breakdown" tabindex="-1" role="dialog" aria-labelledby="newticketsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title inline text-white" id="exampleModalLabel">
                    {{ $stackingpool->staking_pool_package->name }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" style="color: #FFF;">
                    <thead>
                        <tr>
                            <th scope="col">Amount</th>
                            <th scope="col">Percentage</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $stackingpool->amount }}</td>
                            <td>{{ $stackingpool->percent }}</td>
                            <td>{{ $stackingpool->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
