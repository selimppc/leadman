<div class="modal-dialog">
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
                    <td>{{ isset($invoice->invoice_number)?$invoice->invoice_number:'' }}</td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>{{ isset($invoice->total_cost)?$invoice->total_cost:'' }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ isset($invoice->relUser)?$invoice->relUser['username']:'' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ isset($invoice->status)?ucfirst($invoice->status):'' }}</td>
                </tr>
            </table>



            <table class="table table-bordered table-responsive">
                <h4 class="text-center">Invoice Details</h4>
                <tr>
                    <th>Lead Email</th>
                    <th>Unit Price</th>
                </tr>
                @foreach($invoice->relInvoiceDetail as $invoice_details)
                    <tr>
                        <td>{{ $invoice_details->relLead->email }}</td>
                        <td>{{ $invoice_details->unit_price }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
        </div>

    </div>
</div>