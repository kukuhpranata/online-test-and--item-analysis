@if(session()->has('flash_notification.message'))
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="body">
            <div class="alert bg-{{ session()->get('flash_notification.level') }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! session()->get('flash_notification.message') !!}
            </div>
        </div>
    </div>
</div>
@endif