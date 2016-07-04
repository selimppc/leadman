<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
            <h4 class="modal-title">
                {{ $pageTitle }}</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="adv-table">
                                {!! nl2br($file_content) !!}
                                {{--<span class="pull-right">{!! $leads->appends( $_REQUEST ) !!} </span>--}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div style="padding: 4%">
            Download the File
            <a href="{{ URL::to('admin/lead-archive/get-download/'.$file_name)}}" class="btn btn-success" type="button"> <span class="glyphicon glyphicon-download-alt"> Download File </span> </a>
        </div>

        <div class="modal-footer">
            <a href="{{ URL::previous()}}" class="btn btn-default" type="button"> Close </a>
        </div>

    </div>
</div>