<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Popping Email View</h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>User Name</th>
                    <td>{{ isset($popping_email->user_id)?$popping_email->relUser->username:'' }}</td>
                </tr>
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
                <tr>
                    <th>Price</th>
                    <td>{{ isset($popping_email->price)?$popping_email->price:'' }}</td>
                </tr>
                <tr>
                    <th>Schedule</th>
                    <td>
                        @if(isset($popping_email->relSchedule->day))
                            Day-{{ $popping_email->relSchedule->day }}
                            Time-{{ $popping_email->relSchedule->time }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Next Execution Time</th>
                    <td>{{ isset($popping_email->execution_time)?$popping_email->execution_time:'' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ isset($popping_email->status)?$popping_email->status:'' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ isset($popping_email->created_at)?date('Y-m-d',strtotime($popping_email->created_at)):'' }}</td>
                </tr>
            </table>
        </div>

        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
        </div>

    </div>
</div>