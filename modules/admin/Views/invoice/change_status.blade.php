<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">Change Status</h4>
        </div>
        <div class="modal-body">

            {!! Form::model($invoice, ['method' => 'PATCH', 'url'=> ['admin/invoice/update_status', $invoice->id]]) !!}
            <div class="form-group">
                <?php
                $status=Config::get('custom.invoice_status');
                ?>
                {!! Form::select('status',$status,null,['class'=>'form-control','placeholder'=>'Invoice Number']) !!}
            </div>

            <p> &nbsp; </p>

            <a href="{{ URL::previous() }}"  class="btn btn-default" type="button"> Close </a>

            {!! Form::submit('Change status', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>