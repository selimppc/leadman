<div class="modal-dialog  modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Invoice Details</h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped">
                <h4 class="text-center">Invoice Informations</h4>
                <tr>
                    <th>Invoice Number</th>
                    <td>{{ isset($invoice_head->invoice_number)?$invoice_head->invoice_number:'' }}</td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>{{ isset($invoice_head->total_cost)?$invoice_head->total_cost:'' }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ isset($invoice_head->relUser)?$invoice_head->relUser['username']:'' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ isset($invoice_head->status)?ucfirst($invoice_head->status):'' }}</td>
                </tr>
            </table>



            <table class="table table-bordered table-responsive">
                <h4 class="text-center">Invoice Details</h4>
                <tr>
                    <th>Date</th>
                    <th>No of Lead</th>
                    <th>Cost</th>
                </tr>

                @if($date_wise)
                    @foreach($date_wise as $values)
                        <tr>
                            <td>{{ date('F d, Y', strtotime($values->created_at))  }}</td>
                            <td>{{ $values->no_of_lead }}</td>
                            <td>{{ number_format($values->cost, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    {{ " NO Data Found ! " }}
                @endif
            </table>
        </div>

        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
        </div>

    </div>
</div>