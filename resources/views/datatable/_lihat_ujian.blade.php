@if(Auth::user()->role_id == 2)
    {!! Form::model($model, ['url' => $lihat_ujian_url, 'method' => 'get'] ) !!}
    {!! Form::button('<i class="material-icons">exit_to_app</i><span><b>Lihat Ujian</b></span>', array('type' => 'submit', 'class' => 'btn bg-indigo waves-effect')) !!}
    {!! Form::close() !!}
@endif

@if(Auth::user()->role_id == 1)
    {!! Form::model($model, ['url' => $lihat_ujian_url, 'method' => 'get'] ) !!}
    {!! Form::button('<i class="material-icons">exit_to_app</i><span><b>Preview</b></span>', array('type' => 'submit', 'class' => 'btn bg-indigo waves-effect')) !!}
    {!! Form::close() !!}
@endif