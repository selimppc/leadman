<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Popping Email View</h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Email</th>
                    <td>{{ isset($popping_email->email)?$popping_email->email:'' }}</td>
                </tr>
                <tr>
                    <th>Smtp Name</th>
                    <td>{{ isset($popping_email->smtp_id)?$popping_email->relSmtp->name:'' }}</td>
                </tr>
                <tr>
                    <th>Imap Name</th>
                    <td>{{ isset($popping_email->imap_id)?$popping_email->relImap->name:'' }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ isset($popping_email->country_origin)?$popping_email->relCountry->title:'' }}</td>
                </tr>
            </table>
        </div>

        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
        </div>

    </div>
</div>