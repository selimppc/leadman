<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Invoice Details</h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Email</th>
                    <td>{{ isset($invoice->relPoppingEmail)?$invoice->relPoppingEmail['email']:'' }}</td>
                </tr>
                <tr>
                    <th>Invoice Number</th>
                    <td>{{ isset($invoice->invoice_number)?$invoice->invoice_number:'' }}</td>
                </tr>
                <tr>
                    <th>Unit Price</th>
                    <td>{{ isset($invoice->relInvoiceDetail)?$invoice->relInvoiceDetail['unit_price']:'' }}</td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>{{ isset($invoice->total_cost)?$invoice->total_cost:'' }}</td>
                </tr>
                <tr>
                    <th>Lead Email</th>
                    <td>{{ isset($invoice->relInvoiceDetail->relLead)?$invoice->relInvoiceDetail->relLead->email:'' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ isset($invoice->status)?ucfirst($invoice->status):'' }}</td>
                </tr>
            </table>
        </div>

        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
        </div>

    </div>
</div>